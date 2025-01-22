@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-4">Pets</h1>

        <!-- Przycisk dodawania nowego zwierzęcia -->
        <a href="{{ route('pets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add New Pet
        </a>

        <!-- Filtry statusów -->
        <div class="mt-4 space-x-2">
            @foreach ($statuses as $status)
                <a href="{{ route('pets.index', ['status' => $status->value]) }}"
                   class="px-4 py-2 rounded text-white
                   @if ($status->value === $currentStatus)
                       bg-blue-700
                   @else
                       bg-gray-600 hover:bg-gray-700
                   @endif">
                    {{ ucfirst($status->value) }}
                </a>
            @endforeach
        </div>

        <!-- Lista zwierząt -->
        <ul class="mt-4 space-y-2">
            @forelse ($pets as $pet)
                <li class="border p-4 rounded shadow hover:bg-gray-100 flex justify-between items-center">
                    <div>
                        <a href="{{ route('pets.show', $pet['id']) }}" class="text-blue-600 hover:underline">
                            {{ $pet['name'] ?? 'NO_NAME' }}
                        </a> -
                        <span class="text-gray-600">Status: {{ ucfirst($pet['status']) }}</span>
                    </div>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </li>
            @empty
                <p class="text-gray-600">No pets found for the selected status.</p>
            @endforelse
        </ul>
    </div>
@endsection
