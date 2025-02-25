<x-layout>
    <x-slot:title>Jobs</x-slot:title>
    <x-slot:heading>Job Listings</x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="text-blue-500 hover:underline">
                <li><strong>{{ $job['title'] }}</strong> : pays {{ $job['salary'] }} per year</li>
            </a>
        @endforeach
    </ul>
</x-layout>
