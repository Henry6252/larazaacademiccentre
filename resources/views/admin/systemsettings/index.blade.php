@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl bg-white p-6 rounded-xl shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">System Settings</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.systemsettings.update') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-gray-700">School Name</label>
            <input type="text" name="school_name" value="{{ old('school_name', $settings->school_name ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-gray-700">School Email</label>
            <input type="email" name="school_email" value="{{ old('school_email', $settings->school_email ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-gray-700">Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $settings->contact_number ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-gray-700">Address</label>
            <textarea name="address" rows="3"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-300">{{ old('address', $settings->address ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700">Academic Year</label>
            <input type="text" name="academic_year" value="{{ old('academic_year', $settings->academic_year ?? '') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-300">
        </div>

        <div>
            <label class="block text-gray-700">Theme Color</label>
            <input type="color" name="theme_color" value="{{ old('theme_color', $settings->theme_color ?? '#4F46E5') }}"
                class="w-16 h-10 border-gray-300 rounded-lg shadow-sm">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
