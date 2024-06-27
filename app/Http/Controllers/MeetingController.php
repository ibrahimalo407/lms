<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use Chatify\Facades\Chatify;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
        $students = User::whereHas('roles', function ($query) {
            $query->where('title', 'student');
        })->get();
        $groups = Group::all();
        return view('admin.meetings.index', ['meetings' => $meetings, 'students' => $students, 'groups' => $groups]);
    }

    public function deleteMeeting($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return response()->json(['success' => 'Meeting deleted successfully']);
    }

    public function inviteStudents(Request $request, $meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $students = User::whereIn('id', $request->student_ids)->get();

        foreach ($students as $student) {
            $student->notify(new MeetingInvitation($meeting));
        }

        return response()->json(['success' => 'Invitations sent successfully.']);
    }

    public function addGroupToMeeting(Request $request, $meetingId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $groups = Group::whereIn('id', $request->group_ids)->get();

        foreach ($groups as $group) {
            foreach ($group->students as $student) {
                $student->notify(new MeetingInvitation($meeting));
            }
        }

        return response()->json(['success' => 'Meeting added to groups successfully.']);
    }
}
