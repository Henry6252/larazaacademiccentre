<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Teacher Dashboard</h2>
    </x-slot>

    <div class="py-10 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-dashboard.card title="My Courses" description="View and manage your assigned courses" link="#" color="bg-cyan-600" />
            <x-dashboard.card title="Class Schedule" description="See upcoming classes and timings" link="#" color="bg-amber-600" />
            <x-dashboard.card title="Student Grades" description="Submit and view student performance" link="#" color="bg-pink-600" />
        </div>
    </div>
</x-app-layout>
