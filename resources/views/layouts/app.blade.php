<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Management System')</title>
    <style>
        :root {
            font-family: Arial, sans-serif;
            color: #1f2937;
            background: #f3f4f6;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        a {
            color: #2563eb;
        }

        .site-header {
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }

        .nav-container,
        .page-container {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            min-height: 64px;
        }

        .brand {
            color: #111827;
            font-weight: 700;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-links a {
            color: #374151;
            font-size: 14px;
            text-decoration: none;
        }

        .nav-links a:hover,
        .brand:hover {
            color: #2563eb;
        }

        .user-name {
            color: #6b7280;
            font-size: 14px;
        }

        .page-container {
            margin-top: 32px;
            margin-bottom: 32px;
        }

        .page-header,
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        h1,
        h2 {
            margin: 0;
            color: #111827;
        }

        h2 {
            margin-bottom: 16px;
            font-size: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 14px;
            border: 1px solid #2563eb;
            border-radius: 6px;
            color: white;
            background: #2563eb;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .button-secondary {
            border-color: #6b7280;
            color: #374151;
            background: white;
        }

        .button-danger {
            border-color: #dc2626;
            color: #dc2626;
            background: white;
        }

        .button-danger:hover {
            color: white;
            background: #dc2626;
        }

        .nav-logout,
        .actions form {
            margin: 0;
        }

        .card-grid {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
        }

        .card,
        .form-card,
        .detail-card,
        .table-wrapper {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
        }

        .card {
            flex: 1;
            padding: 20px;
        }

        .card-label {
            margin: 0 0 8px;
            color: #6b7280;
            font-size: 14px;
        }

        .card-value {
            margin: 0;
            color: #111827;
            font-size: 28px;
            font-weight: 700;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th,
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            color: #374151;
            background: #f9fafb;
            font-size: 13px;
        }

        td {
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .message {
            padding: 28px;
            color: #6b7280;
            text-align: center;
        }

        .success {
            padding: 12px 16px;
            border: 1px solid #86efac;
            border-radius: 6px;
            color: #166534;
            background: #f0fdf4;
        }

        .search-form,
        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-form {
            width: 100%;
        }

        .search-input {
            width: min(320px, 100%);
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
            font-size: 14px;
        }

        .actions {
            margin-top: 24px;
        }

        .form-card,
        .detail-card {
            width: min(760px, 100%);
            padding: 28px;
            margin: 0 auto;
        }

        .form-card h1,
        .detail-card h1 {
            margin-bottom: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            color: #374151;
            font-size: 14px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            color: #1f2937;
            background: white;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
            outline: 2px solid #bfdbfe;
        }

        .error {
            margin: 0;
            color: #b91c1c;
            font-size: 13px;
        }

        dl {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 12px 20px;
            margin: 0;
        }

        dt {
            color: #6b7280;
            font-weight: 600;
        }

        dd {
            margin: 0;
        }

        @media (max-width: 700px) {
            .nav-container,
            .page-container {
                width: min(100% - 20px, 1200px);
            }

            .nav-container,
            .nav-links,
            .page-header,
            .toolbar,
            .card-grid {
                align-items: stretch;
                flex-direction: column;
            }

            .nav-container {
                padding: 14px 0;
            }

            .nav-links a,
            .nav-logout,
            .page-header .button,
            .search-input,
            .search-form .button {
                width: 100%;
                text-align: center;
            }

            .search-input {
                text-align: left;
            }

            .form-card,
            .detail-card {
                padding: 20px;
            }

            .form-grid,
            dl {
                grid-template-columns: 1fr;
            }

            dd {
                margin-bottom: 12px;
            }

            .actions {
                align-items: stretch;
                flex-direction: column;
            }

            .actions .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <nav class="nav-container" aria-label="Main navigation">
            <a class="brand" href="{{ route('dashboard') }}">Student Management System</a>

            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('students.index') }}">Students</a>
                <a href="{{ route('students.create') }}">Add Student</a>
                @auth
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <form class="nav-logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button button-secondary" type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <main class="page-container">
        @yield('content')
    </main>
</body>
</html>