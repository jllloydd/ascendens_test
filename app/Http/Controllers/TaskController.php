<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Function to display all tasks
    public function index()
    {
        // Fetch tasks only for the authenticated user
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasksview', compact('tasks'));
    }

    // Storing the task created in the form
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // Creating the task and associating it with the current authenticated user
        auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasksview')->with('success', 'Task created successfully.');
    }
    
    // Showing the form for editing a task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Updating the task according to the edited values in the form
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update($request->all());
        return redirect()->route('tasksview')->with('success', 'Task updated successfully.');
    }

    // Deleting a task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasksview')->with('success', 'Task deleted successfully.');
    }
}
