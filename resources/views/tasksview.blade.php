<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Create Task Button -->
            <div class="mb-4 flex justify-end">
                <button onclick="openModal()"
                    class="bg-white hover:bg-gray-200 text-black font-bold py-2 px-4 rounded text-sm sm:text-base">
                    Create New Task
                </button>
            </div>

            <!-- Tasks Grid -->
            @if($tasks->isEmpty())
                <div class="text-center text-gray-600 py-6 text-4xl font-bold">
                    No tasks found. Create one to get started!
                </div>
            @else
                <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 text-gray-900 grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4">
                        @foreach ($tasks as $task)
                            <div class="bg-gray-800 p-4 border border-white rounded-lg">
                                <h2 class="text-lg text-gray-300 sm:text-xl font-semibold">{{ $task->title }}</h2>
                                <p class="text-gray-300 text-sm sm:text-base">{{ $task->description }}</p>
                                <div class="mt-2 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                    <button onclick="openEditModal({{ $task }})" class="text-white rounded-lg bg-blue-600 px-3 py-2 text-sm sm:text-base w-full sm:w-auto">Edit</button>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="text-white rounded-lg bg-red-600 px-3 py-2 text-sm sm:text-base w-full sm:w-auto">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Create Task Modal -->
    <div id="createTaskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Create New Task</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Task</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Edit Task</h3>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="editTaskForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="edit_title" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="edit_description" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Task</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('createTaskModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createTaskModal').classList.add('hidden');
        }

        function openEditModal(task) {
            document.getElementById('editTaskModal').classList.remove('hidden');
            document.getElementById('edit_title').value = task.title;
            document.getElementById('edit_description').value = task.description;
            document.getElementById('editTaskForm').action = `/tasks/${task.id}`;
        }

        function closeEditModal() {
            document.getElementById('editTaskModal').classList.add('hidden');
        }
    </script>
</x-app-layout>