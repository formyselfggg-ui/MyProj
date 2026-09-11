@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <section class="form-card">
        <h1>Add Student</h1>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                @foreach ([
                    'student_id' => 'Student ID',
                    'first_name' => 'First Name',
                    'middle_name' => 'Middle Name',
                    'last_name' => 'Last Name',
                    'age' => 'Age',
                    'email' => 'Email',
                    'phone' => 'Phone',
                ] as $field => $label)
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $label }}</label>
                        <input id="{{ $field }}" name="{{ $field }}" type="{{ $field === 'age' ? 'number' : ($field === 'email' ? 'email' : 'text') }}" value="{{ old($field) }}" @if ($field === 'age') min="1" max="100" @endif @if ($field !== 'middle_name') required @endif>
                        @error($field)
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        @foreach (['Male', 'Female'] as $gender)
                            <option value="{{ $gender }}" @selected(old('gender') === $gender)>{{ $gender }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" name="course" required>
                        <option value="">Select course</option>
                        @foreach (['BSIT', 'BSCS', 'BSIS', 'BSED', 'BEED', 'BSHM', 'BSBA'] as $course)
                            <option value="{{ $course }}" @selected(old('course') === $course)>{{ $course }}</option>
                        @endforeach
                    </select>
                    @error('course')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="year_level">Year Level</label>
                    <select id="year_level" name="year_level" required>
                        <option value="">Select year level</option>
                        @foreach (range(1, 4) as $yearLevel)
                            <option value="{{ $yearLevel }}" @selected((int) old('year_level') === $yearLevel)>Year {{ $yearLevel }}</option>
                        @endforeach
                    </select>
                    @error('year_level')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="actions">
                <a class="button button-secondary" href="{{ route('students.index') }}">Cancel</a>
                <button class="button" type="submit">Save Student</button>
            </div>
        </form>
    </section>
@endsection
