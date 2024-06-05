<?php
namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\CourseStudent;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function courseRequests()
    {
        $requests = CourseRequest::with('course', 'user')->get();
        return view('admin.course-requests', compact('requests'));
    }

    public function approveRequest($id)
    {
        $request = CourseRequest::findOrFail($id);

        CourseStudent::create([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
        ]);

        $request->delete();

        return redirect()->route('admin.course-requests')->with('success', 'Request approved and student added to course.');
    }

    public function rejectRequest($id)
    {
        $request = CourseRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.course-requests')->with('error', 'Request rejected.');
    }
}
