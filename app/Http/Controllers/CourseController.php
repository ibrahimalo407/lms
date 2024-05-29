<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){

        $courses =  Course::where('published', 1)->latest()->get();
        $purchased_courses = [];
        if (auth()->check()) {
            $purchased_courses = Course::whereHas('students', function($query) {
                $query->where('users.id', auth()->id());
            })
            ->with('lessons')
            ->orderBy('id', 'desc')
            ->get();
        }

        return view('courses', compact('courses','purchased_courses'));
    }

    public function show($course_slug)
    {
        $course = Course::where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $purchased_course = auth()->check() && $course->students()->where('user_id', auth()->id())->count() > 0;

        return view('course', compact('course', 'purchased_course'));


    }

    public function payment(Request $request)
    {
        $course = Course::findOrFail($request->get('course_id'));

        $course->students()->attach(auth()->id());

        return redirect()->route('lessons.show', [$course->id, $request->lesson_id]);
    }

    public function rating($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $course->students()->updateExistingPivot(auth()->id(), ['rating' => $request->get('rating')]);

        return redirect()->back()->with('success', 'Thank you for rating.');
    }


    public function storeImageForCourse(Request $request, Course $course)
    {
        // Vérifiez si le dossier pour les cours existe
        if (!Storage::exists('cours')) {
            Storage::makeDirectory('cours');
        }

        // Stockez l'image dans le dossier des cours avec un nom unique
        $imagePath = $request->file('image')->store('cours', 'public');

        // Associez le chemin d'accès de l'image à l'entité de cours
        $course->image_path = $imagePath;
        $course->save();

        // Vous pouvez également récupérer l'URL de l'image ainsi
        $imageUrl = Storage::url($imagePath);

        // Faites ce dont vous avez besoin avec l'URL de l'image, par exemple, retournez-la ou l'utiliser dans une vue
        return response()->json(['image_url' => $imageUrl]);
    }

}
