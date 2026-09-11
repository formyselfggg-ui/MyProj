@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <header class="page-header">
        <h1>Student Dashboard</h1>
    </header>

    <section class="card-grid" aria-label="Student statistics">
        <article class="card">
            <p class="card-label">Total Students</p>
            <p class="card-value">{{ $totalStudents }}</p>
        </article>
        <article class="card">
            <p class="card-label">Male Students</p>
            <p class="card-value">{{ $maleStudents }}</p>
        </article>
        <article class="card">
            <p class="card-label">Female Students</p>
            <p class="card-value">{{ $femaleStudents }}</p>
        </article>
    </section>

    <section>
        <h2>Recent Students</h2>
        <div class="table-wrapper">
            @forelse ($recentStudents as $student)
                @if ($loop->first)
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Year Level</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ trim($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->year_level }}</td>
                            </tr>
                @if ($loop->last)
                        </tbody>
                    </table>
                @endif
            @empty
                <div class="message">No students found.</div>
            @endforelse
        </div>
    </section>
@endsection
