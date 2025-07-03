<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Student Dashboard</h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-dashboard.card title="My Courses" description="Check your enrolled classes" link="#" color="bg-black" />
            <x-dashboard.card title="Exam Schedule" description="Upcoming tests and assessments" link="#" color="bg-emerald-600" />
            <x-dashboard.card title="Academic Results" description="Your past grades & performance" link="#" color="bg-orange-600" />
        </div>
    </div>
</x-app-layout>
