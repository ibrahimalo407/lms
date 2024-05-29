<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Chartjs\Chartjs;


class DashboardController extends Controller
{

public function index()
{
    // Données pour les graphiques
    $coursesData = Course::select(DB::raw('count(*) as count'), DB::raw('MONTH(created_at) as month'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('count', 'month')->toArray();

    $lessonsData = Lesson::select(DB::raw('count(*) as count'), DB::raw('MONTH(created_at) as month'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('count', 'month')->toArray();

    $recentLessons = Lesson::with('course')->latest()->take(5)->get();

    $enrollmentsData = DB::table('course_user')
        ->select(DB::raw('count(*) as count'), DB::raw('MONTH(created_at) as month'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('count', 'month')->toArray();

    // Données pour le graphique des meilleurs étudiants
    $topStudentsData = User::with('testResults')
    ->select('name', DB::raw('AVG(test_result) as average_score'))
    ->join('test_results', 'users.id', '=', 'test_results.user_id')
    ->groupBy('users.id')
    ->orderByDesc('average_score')
    ->take(5)
    ->pluck('average_score', 'name')
    ->toArray();

        
    // Données pour le graphique des inscriptions récentes
    $recentEnrollmentsData = DB::table('course_user')
        ->join('users', 'course_user.user_id', '=', 'users.id')
        ->join('courses', 'course_user.course_id', '=', 'courses.id')
        ->select('users.name', DB::raw('count(*) as count'))
        ->groupBy('users.name')
        ->orderByDesc('count')
        ->take(5)
        ->pluck('count', 'users.name')->toArray();

    return view('admin.dashbord', compact(
        'coursesData', 'lessonsData', 'enrollmentsData', 'topStudentsData', 'recentEnrollmentsData','recentLessons'
    ));
    }

}

