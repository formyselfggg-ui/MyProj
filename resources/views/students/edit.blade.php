@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <section class="form-card">
        <h1>Edit Student</h1>

        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input id="student_id" name="student_id" type="text" value="{{ old('student_id', $student->student_id) }}" required>
                    @error('student_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $student->first_name) }}" required>
                    @error('first_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input id="middle_name" name="middle_name" type="text" value="{{ old('middle_name', $student->middle_name) }}">
                    @error('middle_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $student->last_name) }}" required>
                    @error('last_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select gender</option>
                        @foreach (['Male', 'Female'] as $gender)
                            <option value="{{ $gender }}" @selected(old('gender', $student->gender) === $gender)>{{ $gender }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input id="age" name="age" type="number" min="1" max="100" value="{{ old('age', $student->age) }}" required>
                    @error('age')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" name="course" required>
                        <option value="">Select course</option>
                        @foreach (['BSIT', 'BSCS', 'BSIS', 'BSED', 'BEED', 'BSHM', 'BSBA'] as $course)
                            <option value="{{ $course }}" @selected(old('course', $student->course) === $course)>{{ $course }}</option>
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
                            <option value="{{ $yearLevel }}" @selected((int) old('year_level', $student->year_level) === $yearLevel)>Year {{ $yearLevel }}</option>
                        @endforeach
                    </select>
                    @error('year_level')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $student->email) }}" required>
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone', $student->phone) }}" required>
                    @error('phone')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="actions">
                <a class="button button-secondary" href="{{ route('students.index') }}">Cancel</a>
                <button class="button" type="submit">Update Student</button>
            </div>
        </form>
    </section>
@endsection
