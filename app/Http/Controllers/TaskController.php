<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('order')->get();
        return view('welcome', compact('tasks'));
    }

    public function store(Request $request)
    {

        Task::create([
            'name' => $request->name,
            'order' => Task::count() + 1
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task=Task::where("id",$id)->first();
        return view('edit', compact('task')); 
    }

    public function update(Request $request, Task $task)
    {
        // Validation

        $task->update([
            'name' => $request->name
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function reorderTasks(Request $request)
    {
        $taskIds = $request->input('taskIds');

        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
