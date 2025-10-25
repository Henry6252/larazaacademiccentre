@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Super Admin Dashboard</h1>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-600 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold">Admins</h2>
            <p class="text-3xl">{{ $admins->count() }}</p>
        </div>
        <div class="bg-green-600 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold">Tutors</h2>
            <p class="text-3xl">{{ \App\Models\User::role('tutor')->count() }}</p>
        </div>
        <div class="bg-purple-600 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold">Students</h2>
            <p class="text-3xl">{{ \App\Models\User::role('student')->count() }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-3xl">{{ \App\Models\User::count() }}</p>
        </div>
    </div>

    {{-- Manage Admins --}}
    <div class="bg-white shadow rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">Manage Admins</h2>
            <a href="{{ route('superadmin.admins.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                + Add Admin
            </a>
        </div>

        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700">
                    <th class="p-3 border">Name</th>
                    <th class="p-3 border">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border">{{ $admin->name }}</td>
                    <td class="p-3 border">{{ $admin->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
