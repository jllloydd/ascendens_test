
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Task</a>
                    <div class="mt-4">
                        @foreach ($tasks as $task)
                            <div class="bg-white p-4 shadow rounded mb-4">
                                <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                                <p class="text-gray-600">{{ $task->description }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>