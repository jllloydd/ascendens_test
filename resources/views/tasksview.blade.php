<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Task Button -->
            <div class="mb-4 flex justify-end">
                <button onclick="openModal()"
                    class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    Create New Task
                </button>
            </div>

            <!-- Tasks List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($tasks as $task)
                        <div class="bg-white p-4 shadow rounded">
                            <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                            <p class="text-gray-600">{{ $task->description }}</p>
                            <div class="mt-2">
                                <button onclick="openEditModal({{ $task }})" class="text-white ml-2 rounded-lg bg-blue-600 px-2 py-2">Edit</button>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white ml-2 rounded-lg bg-red-600 px-2 py-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
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