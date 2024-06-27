<?php

use GuzzleHttp\Client;
use App\Models\VirtualClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZoomController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\WherebyController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CourseRequestController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\VirtualClassController;
use App\Http\Controllers\Admin\QuestionOptionController;
use App\Http\Controllers\Admin\PedagogicalPathController;

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

// use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/course-requests', [AdminController::class, 'courseRequests'])->name('admin.course-requests');
    Route::post('/admin/course-requests/{request}/approve', [AdminController::class, 'approveRequest'])->name('admin.course-requests.approve');
    Route::post('/admin/course-requests/{request}/reject', [AdminController::class, 'rejectRequest'])->name('admin.course-requests.reject');
});



// Route::get('login/zoom', [ZoomController::class, 'redirectToProvider'])->name('login.zoom');
// Route::get('zoom/callback', [ZoomController::class, 'handleProviderCallback']);
// Route::post('zoom/meeting/create', [ZoomController::class, 'createZoomMeeting'])->name('zoom.meeting.create');

// Route::middleware(['auth', 'permission:group_access'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('groups', GroupController::class);
//     // Route::post('groups/{group}/addStudent', [GroupController::class, 'addStudent'])->name('groups.addStudent');
//     Route::put('groups/{group}/updateRestriction/{user}', 'GroupController@updateRestriction')->name('groups.updateRestriction');
//     Route::delete('groups/{group}/removeUser/{user}', 'GroupController@removeUser')->name('groups.removeUser');
//     Route::get('restricted-students', 'GroupController@restrictedStudents')->name('groups.restrictedStudents');
// });

Route::middleware(['auth', 'permission:group_access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::get('groups/{group}/students', [GroupController::class, 'showStudents'])->name('groups.showStudents');
    Route::post('groups/{group}/students/{student}/restrict', [GroupController::class, 'restrictStudent'])->name('groups.restrictStudent');
    Route::post('groups/{group}/students/{student}/remove', [GroupController::class, 'removeStudent'])->name('groups.removeStudent');
    Route::get('groups/{group}/students/restricted', [GroupController::class, 'showRestrictedStudents'])->name('groups.showRestrictedStudents');
});



Route::middleware(['auth', 'groupOrPathPermission:pedagogical_path_access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::resource('pedagogical-paths', PedagogicalPathController::class);
});

// Route::resource('classrooms', ClassroomController::class);
Route::resource('courses', CourseController::class);
Route::resource('course-requests', CourseRequestController::class, ['only' => ['index', 'update']]);

// les routes pour le catalogue de cours

Route::get('/catalog', [CourseController::class, 'catalog'])->name('catalog');
Route::post('/catalog/request/{course}', [CourseRequestController::class, 'store'])->name('course-requests.store');
Route::get('/course-requests', [CourseRequestController::class, 'index'])->name('course-requests.index');
Route::post('/course-requests/{id}', [CourseRequestController::class, 'update'])->name('course-requests.update');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('meetings', [MeetingController::class, 'listMeetings'])->name('meetings.index');
    Route::post('meetings', [MeetingController::class, 'createMeeting'])->name('meetings.create');
    Route::delete('meetings/{id}', [MeetingController::class, 'deleteMeeting'])->name('meetings.delete');
    Route::post('/meetings/{meeting}/invite', [MeetingController::class, 'inviteStudents'])->name('meetings.invite');
    Route::post('/meetings/{meeting}/add-group', [MeetingController::class, 'addGroupToMeeting'])->name('meetings.addGroup');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{slug}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
Route::post('courses/payment', [App\Http\Controllers\CourseController::class, 'payment'])->name('courses.payment');
Route::post('course/{course_id}/rating', [App\Http\Controllers\CourseController::class, 'rating'])->name('courses.rating');

Route::get('lessons/{course_id}/{slug}', [App\Http\Controllers\LessonController::class, 'show'])->name('lessons.show');
Route::post('lesson/{slug}/test', [App\Http\Controllers\LessonController::class, 'test'])->name('lessons.test');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
