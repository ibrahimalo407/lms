<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\VirtualClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ZoomController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('zoom')->scopes(['meeting:write', 'user:read'])->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $zoomUser = Socialite::driver('zoom')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Unable to login using Zoom. Please try again.');
        }

        // Enregistrer l'utilisateur avec les détails Zoom
        $user = User::updateOrCreate(
            ['email' => $zoomUser->email],
            [
                'name' => $zoomUser->name,
                'zoom_id' => $zoomUser->id,
                'zoom_token' => $zoomUser->token,
                'zoom_refresh_token' => $zoomUser->refreshToken,
            ]
        );

        auth()->login($user);

        return redirect()->route('home')->with('status', 'Logged in with Zoom');
    }

    public function createZoomMeeting(Request $request)
    {
        $user = Auth::user();
        $accessToken = $user->zoom_token;

        $data = [
            'topic' => $request->input('topic', 'Your Meeting Topic'),
            'type' => 2,
            'start_time' => $request->input('start_time', now()->addHour()->toIso8601String()), // Assurez-vous que start_time est au format ISO 8601
            'duration' => $request->input('duration', 30),
            "password" => ""
        ];

        // $client = new Client();
        $client = new Client(['base_uri' => 'https://api.zoom.us']);
        $client->request('POST', '/v2/users/me/meetings', [
                'headers' => [
                "Authorization" => "Bearer $accessToken",
            ],
            'json' => $data,
        ]);

        // Enregistrez les informations de la réunion dans la base de données, si nécessaire

        return view('meetings.show', compact('meeting'));
    }
}
