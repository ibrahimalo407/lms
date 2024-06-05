<?php

namespace App\Http\Controllers;

use App\Models\CourseRequest;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRequestController extends Controller
{
    public function index()
    {
        $courseRequests = CourseRequest::with('course', 'user')->where('status', 'pending')->get();
        return view('course_requests.index', compact('courseRequests'));
    }

    public function store(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);

        $existingRequest = CourseRequest::where('user_id', Auth::id())
            ->where('course_id', $course_id)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You have already requested access to this course.');
        }

        CourseRequest::create([
            'user_id' => Auth::id(),
            'course_id' => $course_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Course request sent.');
    }

    public function update(Request $request, $id)
    {
        $courseRequest = CourseRequest::findOrFail($id);
        $courseRequest->status = $request->input('status');
        $courseRequest->save();

        if ($courseRequest->status == 'approved') {
            Enrollment::create([
                'user_id' => $courseRequest->user_id,
                'course_id' => $courseRequest->course_id,
            ]);
        }

        return redirect()->route('course-requests.index')->with('success', 'Course request updated successfully.');
    }
}
