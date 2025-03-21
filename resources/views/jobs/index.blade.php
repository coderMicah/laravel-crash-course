<x-layout>
    <x-slot:title>Jobs</x-slot:title>
    <x-slot:heading>Job Listings</x-slot:heading>

    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="text-sm text-blue-500">{{ $job->employer->name }}</div>
                <div> <strong>{{ $job['title'] }}</strong> : pays {{ $job['salary'] }} per year</div>
            </a>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $jobs->links()}}
    </div>
</x-layout>
