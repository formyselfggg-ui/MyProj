<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('student_id', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return Inertia::render('students/index', compact('students', 'search'));
    }

    public function create(): Response
    {
        return Inertia::render('students/create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'string', 'max:50', 'unique:students,student_id'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'age' => ['required', 'integer', 'min:1', 'max:100'],
            'course' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'integer', 'between:1,4'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function show(Student $student): Response
    {
        return Inertia::render('students/show', compact('student'));
    }

    public function edit(Student $student): Response
    {
        return Inertia::render('students/edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_id')->ignore($student->id),
            ],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'age' => ['required', 'integer', 'min:1', 'max:100'],
            'course' => ['required', 'string', 'max:255'],
            'year_level' => ['required', 'integer', 'between:1,4'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
