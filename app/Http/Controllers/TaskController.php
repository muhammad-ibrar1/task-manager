<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;    
use App\Models\Project; 

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $query = Task::orderBy('priority');

        if ($request->has('project_id') && $request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        $tasks = $query->get();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'project_id' => 'required|exists:projects,id',
        ]);

        $maxPriority = Task::max('priority') ?? 0;

        Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'priority' => $maxPriority + 1,
        ]);

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|max:100',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $task->update($request->only('name', 'project_id'));

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function reorder(Request $request)
    {
        $orderedIds = $request->input('order'); // array of task IDs in new order

        foreach ($orderedIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }





}
