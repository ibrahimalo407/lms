<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\CourseRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Affiche les cours publiés et les cours achetés
    public function index()
    {
        $courses = Course::where('published', 1)->latest()->get();
        $purchased_courses = [];

        if (auth()->check()) {
            $purchased_courses = Course::whereHas('students', function ($query) {
                $query->where('users.id', auth()->id());
            })
                ->with('lessons')
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('courses', compact('courses', 'purchased_courses'));
    }

    // Affiche un cours spécifique

    public function show($course_slug)
    {
        $course = Course::where('slug', $course_slug)
            ->with('publishedLessons')
            ->firstOrFail();
    
        $user = auth()->user();
    
        // Vérifiez si l'utilisateur est restreint dans l'un des groupes associés au cours
        $isRestricted = $user ? $user->groups()
            ->whereHas('pedagogicalPaths.courses', function ($query) use ($course) {
                $query->where('courses.id', $course->id);
            })
            ->wherePivot('is_restricted', true)
            ->exists() : false;
    
        // Si l'accès est restreint, renvoyez à la vue avec la variable d'accès restreint
        if ($isRestricted) {
            return view('course', compact('course', 'isRestricted'));
        }
    
        $purchased_course = $user && $course->students()->where('user_id', $user->id)->exists();
    
        return view('course', compact('course', 'purchased_course'));
    }
    



    // Traitement de paiement et inscription au cours
    // public function payment(Request $request)
    // {
    //     $course = Course::findOrFail($request->get('course_id'));

    //     $course->students()->attach(auth()->id());

    //     return redirect()->route('lessons.show', [$course->id, $request->lesson_id]);
    // }

    // Notation d'un cours par un étudiant
    public function rating($course_id, Request $request)
    {
        $course = Course::findOrFail($course_id);
        $course->students()->updateExistingPivot(auth()->id(), ['rating' => $request->get('rating')]);

        return redirect()->back()->with('success', 'Thank you for rating.');
    }

    // Stocker l'image pour un cours
    public function storeImageForCourse(Request $request, Course $course)
    {
        if (!Storage::exists('cours')) {
            Storage::makeDirectory('cours');
        }

        $imagePath = $request->file('image')->store('cours', 'public');
        $course->course_image = $imagePath;
        $course->save();

        $imageUrl = Storage::url($imagePath);

        return response()->json(['image_url' => $imageUrl]);
    }

    // Méthode pour afficher le catalogue des cours
    public function catalog()
    {
        $requestedCourses = auth()->check() ? CourseRequest::where('user_id', auth()->id())->pluck('course_id')->toArray() : [];
        $courses = Course::where('published', 1)->whereNotIn('id', $requestedCourses)->get();

        return view('catalog', compact('courses', 'requestedCourses'));
    }



    // // Gère les demandes d'inscription aux cours
    // public function requestCourse($course_id)
    // {
    //     $course = Course::findOrFail($course_id);

    //     $existingRequest = CourseRequest::where('user_id', auth()->id())
    //         ->where('course_id', $course_id)
    //         ->first();

    //     if ($existingRequest) {
    //         return redirect()->back()->with('error', 'You have already requested access to this course.');
    //     } else{

    //         CourseRequest::create([
    //             'user_id' => auth()->id(),
    //             'course_id' => $course_id,
    //             'status' => 'pending',
    //         ]);
    //     }


    //     return redirect()->back()->with('success', 'Course request sent.');
    // }


    // Stocke un nouveau cours dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|integer',
            'course_image' => 'nullable|string',
            'start_date' => 'nullable|date',
            'classroom_id' => 'required|exists:classrooms,id',
            'published' => 'nullable|boolean',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


    // Met à jour un cours existant
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|integer',
            'course_image' => 'nullable|string',
            'start_date' => 'nullable|date',
            'classroom_id' => 'required|exists:classrooms,id',
            'published' => 'nullable|boolean',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    // Supprime un cours
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
