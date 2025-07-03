<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
    </x-slot>

    <div class="py-10 bg-gray-100">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-dashboard.card title="Manage Users" description="Add, edit, and delete users" link="{{ route('admin.users.index') }}" color="bg-indigo-600" />
            <x-dashboard.card title="Courses" description="Create and manage courses" link="{{ route('admin.courses.index') }}" color="bg-blue-600" />
            <x-dashboard.card title="Departments" description="Manage academic departments" link="{{ route('admin.departments.index') }}" color="bg-purple-600" />
            <x-dashboard.card title="Assign Courses" description="Link courses to tutors" link="{{ route('admin.assignments.index') }}" color="bg-red-600" />
            <x-dashboard.card title="Semesters" description="Set up semester timelines" link="{{ route('admin.semesters.index') }}" color="bg-green-600" />
            <x-dashboard.card title="Site Settings" description="Manage portal-wide settings" link="{{ route('admin.settings') }}" color="bg-gray-800" />
        </div>
    </div>
</x-app-layout>
