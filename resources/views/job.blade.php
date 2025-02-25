<x-layout>
    <x-slot:title>Job - {{ $job['id'] }}</x-slot:title>
    <x-slot:heading>Job</x-slot:heading>

    <h2 class="font-bold text-lg">Job Title : {{ $job['title'] }}</h2>
    <p>This job pays {{ $job['salary'] }}</p>
</x-layout>
