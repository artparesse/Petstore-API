@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $pet['name'] ?? 'NO_NAME' }}</h1>
        <p class="text-gray-600 mb-4">Status: {{ $pet['status'] }}</p>
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Photo URLs:</h2>
            <ul class="list-disc list-inside mt-2">
                @foreach($pet['photoUrls'] as $url)
                    <li class="flex">
                        <p class="text-blue-500">{{ $url }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('pets.edit', $pet['id']) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Edit
        </a>
        <a href="{{ route('pets.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to list
        </a>
    </div>
@endsection
