<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\User;
use App\Models\Group; // Assurez-vous d'importer le modèle Group
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Chatify\Facades\ChatifyMessenger as Chatify;

class MeetingController extends Controller
{
    public function createMeeting(Request $request)
    {
        $roomName = $request->input('roomName');

        if (empty($roomName)) {
            return response()->json(['error' => 'Room name is required'], 400);
        }

        $response = Http::withToken(env('WHEREBY_API_KEY'))->post('https://api.whereby.dev/v1/meetings', [
            'endDate' => now()->addHour()->toIso8601String(),
            'fields' => ['hostRoomUrl'],
        ]);

        $data = $response->json();

        if ($response->successful()) {
            $meeting = Meeting::create([
                'roomName' => $roomName,
                'roomUrl' => $data['roomUrl'],
            ]);

            return response()->json($meeting);
        } else {
            return response()->json(['error' => 'Failed to create meeting'], $response->status());
        }
    }

    public function listMeetings()
    {
        $meetings = Meeting::all();
        $users = User::all();
        $groups = Group::all(); // Ajouter cette ligne pour récupérer les groupes
        return view('admin.meetings.index', ['meetings' => $meetings, 'users' => $users, 'groups' => $groups]); // Passer les groupes à la vue
    }

    public function deleteMeeting($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return response()->json(['success' => 'Meeting deleted successfully']);
    }

    public function inviteMeeting(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);
        $userIds = $request->input('userIds');

        if (empty($userIds)) {
            return response()->json(['error' => 'No users selected for invitation'], 400);
        }

        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            // Send email invitation
            Mail::raw("You are invited to a meeting: " . $meeting->roomUrl, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Meeting Invitation');
            });

            // Send Chatify message
            Chatify::sendMessage([
                'from_id' => auth()->user()->id,
                'to_id' => $user->id,
                'body' => "You are invited to a meeting: " . $meeting->roomUrl,
            ]);
        }

        return response()->json(['success' => 'Invitations sent successfully']);
    }

    public function addGroupToMeeting(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);
        $groupId = $request->input('groupId');

        if (!$groupId) {
            return response()->json(['error' => 'Group ID is required'], 400);
        }

        $group = Group::findOrFail($groupId);

        foreach ($group->users as $user) {
            // Send email invitation
            Mail::raw("You are invited to a meeting: " . $meeting->roomUrl, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Meeting Invitation');
            });

            // Send Chatify message
            Chatify::sendMessage([
                'from_id' => auth()->user()->id,
                'to_id' => $user->id,
                'body' => "You are invited to the meeting: " . $meeting->roomUrl,
            ]);
        }

        return response()->json(['success' => 'Group invited successfully']);
    }
}
