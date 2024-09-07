<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Notifications\MeetingInvitation;

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
        return view('admin.meetings.index', compact('meetings'));
    }

    public function deleteMeeting($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return response()->json(['success' => 'Meeting deleted successfully']);
    }

    public function showInviteForm($meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $students = User::whereHas('roles', function ($query) {
            $query->where('title', 'student');
        })->get();
        return view('admin.meetings.invite', compact('meeting', 'students'));
    }

    public function inviteStudents(Request $request, $meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $students = User::whereIn('id', $request->student_ids)->get();

        foreach ($students as $student) {
            // Stocker l'invitation dans la base de données
            Invitation::create([
                'meeting_id' => $meeting->id,
                'student_id' => $student->id,
                'meeting_link' => $meeting->roomUrl,
            ]);
        }

        // Redirection avec un message de succès
        return redirect()->route('admin.meetings.index')
            ->with('success', 'Invitations envoyées avec succès.');
    }





    public function showAddGroupForm($meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $groups = Group::all();
        return view('admin.meetings.add-group', compact('meeting', 'groups'));
    }

    // public function addGroupToMeeting(Request $request, $meetingId)
    // {
    //     $meeting = Meeting::findOrFail($meetingId);

    //     // Validate request
    //     $request->validate([
    //         'group_ids' => 'required|array',
    //         'group_ids.*' => 'exists:groups,id',
    //     ]);

    //     $groups = Group::whereIn('id', $request->group_ids)->get();

    //     if ($groups->isEmpty()) {
    //         return response()->json(['error' => 'No valid groups found'], 400);
    //     }

    //     foreach ($groups as $group) {
    //         if ($group->students->isEmpty()) {
    //             continue; // Skip groups with no students
    //         }

    //         foreach ($group->students as $student) {
    //             $student->notify(new MeetingInvitation($meeting));
    //         }
    //     }

    //     return response()->json(['success' => 'Meeting added to groups successfully.']);
    // }

    public function inviteGroups(Request $request, $meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);

        // Retrieve the groups selected from the request
        $groups = Group::whereIn('id', $request->group_ids)->with('students')->get();

        foreach ($groups as $group) {
            foreach ($group->students as $student) {
                // Store the invitation for each student in the group
                Invitation::create([
                    'meeting_id' => $meeting->id,
                    'student_id' => $student->id,
                    'meeting_link' => $meeting->roomUrl,
                ]);
            }
        }

        $meetings = Meeting::all();

        return redirect()->route('admin.meetings.index')->with('success', 'Invitations envoyées aux groupes avec succès !');
    }
}
