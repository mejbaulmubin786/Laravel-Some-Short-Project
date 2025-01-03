<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
    // 1. Display all tasks
    public function index() {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // 2. Store a new task
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    // 3. Update task completion status
    public function update(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->update([
            'is_completed' => $request->is_completed,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // 4. Delete a task
    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
