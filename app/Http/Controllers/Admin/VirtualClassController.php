<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use App\Models\VirtualClass;
use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class VirtualClassController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }


    public function index()
    {
        // Récupérer toutes les classes virtuelles depuis la base de données
        $virtualClasses = VirtualClass::all();

        // Passer les classes virtuelles récupérées à la vue
        return view('admin.virtual_classes.index', compact('virtualClasses'));
    }
    
    public function authorizeZoom()
    {
        $url = 'https://zoom.us/oauth/authorize?response_type=code&client_id=' . env('ZOOM_CLIENT_ID') . '&redirect_uri=' . env('ZOOM_REDIRECT_URI');
        return redirect($url);
    }

    public function handleZoomCallback(Request $request)
    {
        $code = $request->input('code');
        $response = $this->zoomService->getAccessToken($code);
        Session::put('zoom_access_token', $response['access_token']);

        return redirect()->route('admin.virtual_classes.create');
    }

    public function createMeeting()
{
    // Récupérez le token d'accès stocké
    $accessToken = session('zoom_access_token');

    if (!$accessToken) {
        return redirect()->route('login.zoom');
    }

    $client = new Client();
    $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'topic' => 'New Meeting',
            'type' => 1,  // Instant meeting
            'start_time' => now()->toIso8601String(),
            'duration' => 30,  // 30 minutes
            'timezone' => 'UTC',
        ],
    ]);

    $data = json_decode($response->getBody(), true);

    // Créez une classe virtuelle avec les détails de la réunion
    VirtualClass::create([
        'title' => 'New Meeting',
        'description' => 'This is an example class.',
        'start_time' => now(),
        'end_time' => now()->addMinutes(30),
        'meeting_link' => $data['join_url'],
        'meeting_id' => $data['id'],
        'meeting_password' => $data['password'],
    ]);

    return redirect()->route('admin.virtual_classes.index');
}
    public function store(Request $request)
    {
        $data = [
            'topic' => $request->input('topic'),
            'type' => 2, // Scheduled meeting
            'start_time' => $request->input('start_time'), // DateTime format: 'YYYY-MM-DDTHH:MM:SSZ'
            'duration' => $request->input('duration'), // Meeting duration in minutes
            'agenda' => $request->input('agenda'),
        ];

        $accessToken = Session::get('zoom_access_token');
        $meeting = $this->zoomService->createMeeting($accessToken, $data);

        // Traitez la réponse et sauvegardez les informations dans votre base de données

        return redirect()->route('admin.virtual_classes.index')->with('success', 'Virtual class created successfully.');
    }

/**
     * Affiche le formulaire pour créer une nouvelle classe virtuelle.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.virtual_classes.create');
    }

    /**
     * Enregistre une nouvelle classe virtuelle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'start_time' => 'required|date',
    //         'end_time' => 'required|date|after:start_time',
    //         'meeting_link' => 'required|string|max:255',
    //         'meeting_id' => 'required|string|max:255',
    //         'meeting_password' => 'nullable|string|max:255',
    //     ]);

    //     VirtualClass::create($request->all());

    //     return redirect()->route('admin.virtual_classes.index')
    //         ->with('success', 'Virtual class created successfully.');
    // }

    /**
     * Affiche les détails d'une classe virtuelle spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $virtualClass = VirtualClass::findOrFail($id);
        return view('admin.virtual_classes.show', compact('virtualClass'));
    }

    /**
     * Affiche le formulaire pour éditer une classe virtuelle existante.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $virtualClass = VirtualClass::findOrFail($id);
        return view('admin.virtual_classes.edit', compact('virtualClass'));
    }

    /**
     * Met à jour une classe virtuelle existante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'meeting_link' => 'required|string|max:255',
            'meeting_id' => 'required|string|max:255',
            'meeting_password' => 'nullable|string|max:255',
        ]);

        $virtualClass = VirtualClass::findOrFail($id);
        $virtualClass->update($request->all());

        return redirect()->route('admin.virtual_classes.index')
            ->with('success', 'Virtual class updated successfully.');
    }

    /**
     * Supprime une classe virtuelle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $virtualClass = VirtualClass::findOrFail($id);
        $virtualClass->delete();

        return redirect()->route('admin.virtual_classes.index')
            ->with('success', 'Virtual class deleted successfully.');
    }}
