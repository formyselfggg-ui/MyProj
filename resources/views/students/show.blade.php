@extends('layouts.app')

@section('title', 'View Student')

@section('content')
    <section class="detail-card">
        <h1>Student Details</h1>

        <dl>
            <dt>Student ID</dt>
            <dd>{{ $student->student_id }}</dd>

            <dt>Name</dt>
            <dd>{{ trim($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}</dd>

            <dt>Gender</dt>
            <dd>{{ $student->gender }}</dd>

            <dt>Age</dt>
            <dd>{{ $student->age }}</dd>

            <dt>Course</dt>
            <dd>{{ $student->course }}</dd>

            <dt>Year Level</dt>
            <dd>{{ $student->year_level }}</dd>

            <dt>Email</dt>
            <dd>{{ $student->email }}</dd>

            <dt>Phone</dt>
            <dd>{{ $student->phone }}</dd>
        </dl>

        <div class="actions">
            <a class="button button-secondary" href="{{ route('students.index') }}">Back to Students</a>
            <a class="button" href="{{ route('students.edit', $student) }}">Edit Student</a>
        </div>
    </section>
@endsection
