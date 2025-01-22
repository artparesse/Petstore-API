@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded p-6">
        <h1 class="text-2xl font-bold mb-4">Add New Pet</h1>
        <form action="{{ route('pets.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" id="name" name="name" required
                       class="w-full border-gray-300 rounded p-2">
            </div>
            <div>
                <label for="photoUrls" class="block text-gray-700">Photo Urls:</label>
                <div id="photo-urls-container" class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <input type="text" name="photoUrls[]" class="w-full border-gray-300 rounded p-2" placeholder="Enter photo URL">
                        <button type="button" class="bg-red-600 text-white px-2 py-1 rounded remove-photo-url">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-photo-url" class="mt-2 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Add Photo URL</button>
            </div>
            <div>
                <label for="status" class="block text-gray-700">Status:</label>
                <select id="status" name="status" class="w-full border-gray-300 rounded p-2">
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}">{{ ucfirst($status->value) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Pet
            </button>
        </form>
    </div>

    <script>
        document.getElementById('add-photo-url').addEventListener('click', function () {
            const container = document.getElementById('photo-urls-container');
            const newField = document.createElement('div');
            newField.classList.add('flex', 'items-center', 'space-x-2');
            newField.innerHTML = `
                <input type="text" name="photoUrls[]" class="w-full border-gray-300 rounded p-2" placeholder="Enter photo URL">
                <button type="button" class="bg-red-600 text-white px-2 py-1 rounded remove-photo-url">Remove</button>
            `;
            container.appendChild(newField);

            // Add remove functionality
            newField.querySelector('.remove-photo-url').addEventListener('click', function () {
                newField.remove();
            });
        });

        document.querySelectorAll('.remove-photo-url').forEach(button => {
            button.addEventListener('click', function () {
                button.parentElement.remove();
            });
        });
    </script>
@endsection
