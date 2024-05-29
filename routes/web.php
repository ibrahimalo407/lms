<?php

use GuzzleHttp\Client;
use App\Models\VirtualClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZoomController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\VirtualClassController;
use App\Http\Controllers\Admin\QuestionOptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
    Route::delete('courses_perma_del/{id}', [\App\Http\Controllers\Admin\CourseController::class, 'perma_del'])->name('courses.perma_del');
    Route::post('courses_restore/{id}', [\App\Http\Controllers\Admin\CourseController::class, 'restore'])->name('courses.restore');

    Route::resource('lessons', \App\Http\Controllers\Admin\LessonController::class);
    Route::post('lessons_restore/{id}', [\App\Http\Controllers\Admin\LessonController::class, 'restore'])->name('lessons.restore');
    Route::delete('lessons_perma_del/{id}', [\App\Http\Controllers\Admin\LessonController::class, 'perma_del'])->name('lessons.perma_del');

    Route::resource('tests', \App\Http\Controllers\Admin\TestController::class);
    Route::post('tests_restore/{id}', [\App\Http\Controllers\Admin\TestController::class, 'restore'])->name('tests.restore');
    Route::delete('tests_perma_del/{id}', [\App\Http\Controllers\Admin\TestController::class, 'perma_del'])->name('tests.perma_del');

    Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::post('questions_restore/{id}', [\App\Http\Controllers\Admin\QuestionController::class, 'restore'])->name('questions.restore');
    Route::delete('questions_perma_del/{id}', [\App\Http\Controllers\Admin\QuestionController::class, 'perma_del'])->name('questions.perma_del');

    Route::resource('question_options', \App\Http\Controllers\Admin\QuestionOptionController::class);
    Route::post('question_options_restore/{id}', [\App\Http\Controllers\Admin\QuestionOptionController::class, 'restore'])->name('question_options.restore');
    Route::delete('question_options_perma_del/{id}', [\App\Http\Controllers\Admin\QuestionOptionController::class, 'perma_del'])->name('question_options.perma_del');

    Route::get('/admin/virtual-classes', [VirtualClassController::class, 'index'])->name('admin.virtual_classes.index');
    Route::get('zoom/authorize', [VirtualClassController::class, 'authorizeZoom'])->name('zoom.authorize');
    Route::get('zoom/callback', [VirtualClassController::class, 'handleZoomCallback'])->name('zoom.callback');
    Route::get('virtual_classes', [VirtualClassController::class, 'index'])->name('virtual_classes.index');
    Route::get('virtual_classes/create', [VirtualClassController::class, 'create'])->name('virtual_classes.create');
    Route::post('virtual_classes', [VirtualClassController::class, 'store'])->name('virtual_classes.store');
    Route::get('virtual_classes/{virtual_class}/edit', [VirtualClassController::class, 'edit'])->name('virtual_classes.edit');
    Route::put('virtual_classes/{virtual_class}', [VirtualClassController::class, 'update'])->name('virtual_classes.update');
    Route::delete('virtual_classes/{virtual_class}', [VirtualClassController::class, 'destroy'])->name('virtual_classes.destroy');

    

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('login/zoom', [ZoomController::class, 'redirectToProvider'])->name('login.zoom');
Route::get('zoom/callback', [ZoomController::class, 'handleProviderCallback']);
Route::post('zoom/meeting/create', [ZoomController::class, 'createZoomMeeting'])->name('zoom.meeting.create');


// Route::get('login/zoom', function () {
//     return Socialite::driver('zoom')
//         ->scopes([
//             'meeting:write:meeting',
//             'meeting:write:registrant',
//             'meeting:write:invite_links',
//             'meeting:write:poll',
//             'user:read:user'
//         ])
//         ->stateless()
//         ->redirect();
// })->name('login.zoom');

// Route::get('zoom/callback', [ZoomController::class, 'handleProviderCallback']);

Route::middleware('auth')->group(function () {
    Route::get('meetings/create', function () {
        return view('meetings.create');
    })->name('meetings.create');

    Route::post('meetings', [ZoomController::class, 'createZoomMeeting'])->name('meetings.store');
});



// Route::post('admin/virtual_classes/create-zoom-meeting', function (Illuminate\Http\Request $request) {
//     $accessToken = session('zoom_access_token');

//     if (!$accessToken) {
//         return redirect()->route('login.zoom');
//     }

//     $client = new GuzzleHttp\Client();

//     try {
//         $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
//             'headers' => [
//                 'Authorization' => 'Bearer ' . $accessToken,
//                 'Content-Type' => 'application/json',
//             ],
//             'json' => [
//                 'topic' => $request->input('title'),
//                 'type' => 2,  // Scheduled meeting
//                 'start_time' => $request->input('start_time'),
//                 'duration' => $request->input('duration'),  // Duration in minutes
//                 'timezone' => 'UTC',
//             ],
//         ]);

//         $data = json_decode($response->getBody(), true);

//         // Créez une classe virtuelle avec les détails de la réunion
//         App\Models\VirtualClass::create([
//             'title' => $request->input('title'),
//             'description' => $request->input('description'),
//             'start_time' => $request->input('start_time'),
//             'end_time' => $request->input('end_time'),
//             'meeting_link' => $data['join_url'],
//             'meeting_id' => $data['id'],
//             'meeting_password' => $data['password'],
//         ]);

//         return redirect()->route('admin.virtual_classes.index')->with('success', 'Classe virtuelle créée avec succès!');
//     } catch (\Exception $e) {
//         return redirect()->route('admin.virtual_classes.index')->with('error', 'Erreur lors de la création de la réunion Zoom: ' . $e->getMessage());
//     }
// })->name('create-zoom-meeting');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{slug}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
Route::post('courses/payment', [App\Http\Controllers\CourseController::class, 'payment'])->name('courses.payment');
Route::post('course/{course_id}/rating', [App\Http\Controllers\CourseController::class, 'rating'])->name('courses.rating');

Route::get('lessons/{course_id}/{slug}', [App\Http\Controllers\LessonController::class, 'show'])->name('lessons.show');
Route::post('lesson/{slug}/test', [App\Http\Controllers\LessonController::class, 'test'])->name('lessons.test');
