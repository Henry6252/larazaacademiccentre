<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        
        {{-- Sidebar --}}
        @auth
        <aside class="w-64 bg-gradient-to-b from-gray-900 to-gray-700 text-gray-200 shadow-xl">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-2xl font-bold text-white tracking-wide">📘 Menu</h2>
            </div>
            <ul class="p-4 space-y-2 text-sm">
                {{-- Common --}}
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center px-3 py-2 rounded-md hover:bg-gray-600 transition">
                        🏠 <span class="ml-2">Dashboard</span>
                    </a>
                </li>

                 @role('super-admin')
            <div class="mt-4 border-t border-gray-700 pt-2">
                <p class="px-4 text-sm text-gray-400 uppercase">Super Admin</p>
                <a href="{{ route('superadmin.dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('superadmin.dashboard') ? 'bg-gray-800' : '' }}">
                   Super Admin Dashboard
                </a>
                <a href="{{ route('superadmin.admins.index') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('superadmin.admins.*') ? 'bg-gray-800' : '' }}">
                   Manage Admins
                </a>
            </div>
        @endrole


                {{-- Admin Menu --}}
@role('admin')
<div class="mt-6">
    <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Management</h3>
    <nav class="mt-2 space-y-1">
        <!-- Admin Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">⚙️ Admin Dashboard</a>

        <!-- Manage Users -->
        <a href="{{ route('admin.users.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">👥 Manage Users</a>

        <!-- Course Management -->
        <a href="{{ route('admin.courses.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">📚 Course Management</a>

        <!-- Reports -->
        <a href="{{ route('admin.reports.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">📊 Reports</a>

        <!-- System Settings -->
        <a href="{{ route('admin.systemsettings.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">⚡ System Settings</a>

        <!-- Tutors -->
        <a href="{{ route('admin.tutors.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">👨‍🏫 Tutors</a>

        <!-- Semesters -->
        <a href="{{ route('admin.semesters.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">🗓️ Semesters</a>

        <!-- Academic Years -->
        <a href="{{ route('admin.academic-years.index') }}" 
           class="block px-3 py-2 rounded-md hover:bg-gray-600">📆 Academic Years</a>
    </nav>
</div>
@endrole

                {{-- Tutor Menu --}}
                @role('tutor')
                    <li><a href="{{ route('tutor.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📖 Tutor Dashboard</a></li>
                    <li><a href="{{ route('tutor.classes.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📝 My Classes</a></li>
                    <li><a href="{{ route('tutor.courses.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📝 My Courses</a></li>
                    <li><a href="{{ route('tutor.assessments.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📤 Assessments </a></li>
                    <li><a href="{{ route('tutor.grades.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">✅ Grade Submissions</a></li>
                    <li><a href="{{ route('tutor.attendance.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📅 Attendance</a></li>
                @endrole

                {{-- Student Menu --}}
                @role('student')
                    <li><a href="{{ route('student.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">🎓 Student Dashboard</a></li>
                    <li><a href="{{ route('enrollments.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📥 My Enrollments</a></li>
                    <li><a href="{{ route('mycourses.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📘 My Courses</a></li>
                    <li><a href="{{ route('student.grades.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">📑 Grades</a></li>
                    <li><a href="{{ route('student.profile.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">👤 Profile</a></li>
                    <li><a href="{{ route('student.assignments.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-600">✍️ Assignments</a></li>
                @endrole
            </ul>
        </aside>
        @endauth

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">
            {{-- Navigation --}}
            @include('layouts.navigation')

            {{-- Header --}}
            @if(View::hasSection('header'))
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        @yield('header')
                    </h1>
                </div>
            </header>
            @endif
            @if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
    <p>{{ session('success') }}</p>
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
    <p>{{ session('error') }}</p>
</div>
@endif


            {{-- Page Content --}}
            <main class="flex-1 p-6 bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="max-w-7xl mx-auto">
                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-md bg-green-100 text-green-700 shadow">
                            ✅ {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 rounded-md bg-red-100 text-red-700 shadow">
                            ❌ {{ session('error') }}
                        </div>
                    @endif

                    {{-- Yielded Content --}}
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
