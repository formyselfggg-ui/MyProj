<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $totalStudents = Student::count();
        $maleStudents = Student::where('gender', 'Male')->count();
        $femaleStudents = Student::where('gender', 'Female')->count();
        $recentStudents = Student::latest()->take(5)->get();

        return Inertia::render('dashboard', [
            'totalStudents' => $totalStudents,
            'maleStudents' => $maleStudents,
            'femaleStudents' => $femaleStudents,
            'recentStudents' => $recentStudents,
        ]);
    }
}
