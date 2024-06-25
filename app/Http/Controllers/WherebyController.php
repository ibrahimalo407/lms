<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    public function createMeeting(Request $request)
    {
        $roomName = $request->input('roomName');

        // Vérifiez que le roomName n'est pas vide
        if (empty($roomName)) {
            return response()->json(['error' => 'Room name is required'], 400);
        }

        $response = Http::withToken(env('WHEREBY_API_KEY'))->post('https://api.whereby.dev/v1/meetings', [
            'endDate' => now()->addHour()->toIso8601String(),
            'fields' => ['hostRoomUrl'],
        ]);

        $data = $response->json();

        if ($response->successful()) {
            // Sauvegardez la réunion dans la base de données
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
        // Récupérez les réunions depuis la base de données
        $meetings = Meeting::all();

        return view('admin.meetings.index', ['meetings' => $meetings]);
    }
}
