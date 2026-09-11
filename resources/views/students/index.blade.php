@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <header class="page-header">
        <h1>Students</h1>
        <a class="button" href="{{ route('students.create') }}">Add Student</a>
    </header>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <div class="toolbar">
        <form class="search-form" action="{{ route('students.index') }}" method="GET">
            <input
                class="search-input"
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search by name or student ID"
                aria-label="Search by name or student ID"
            >
            <button class="button" type="submit">Search</button>
            @if ($search)
                <a class="button button-secondary" href="{{ route('students.index') }}">Clear Search</a>
            @endif
        </form>
    </div>

    <div class="table-wrapper">
        @forelse ($students as $student)
            @if ($loop->first)
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            @endif
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ trim($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                <div class="actions">
                                    <a class="button button-secondary" href="{{ route('students.show', $student) }}">View</a>
                                    <a class="button" href="{{ route('students.edit', $student) }}">Edit</a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
            @if ($loop->last)
                    </tbody>
                </table>
            @endif
        @empty
            <div class="message">No students found.</div>
        @endforelse
    </div>
@endsection
