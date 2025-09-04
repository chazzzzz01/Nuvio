<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
public function index(Request $request)
{
    $user = $request->user();

    $tasks = Task::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return Inertia::render('Tasks/Index', [
        'tasks' => $tasks,
        'filters' => $request->only(['search','status']),
    ]);
}


public function create()
{
return Inertia::render('Tasks/Create');
}


public function store(Request $request)
{
$data = $request->validate([
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'status' => 'required|in:todo,in_progress,done',
]);


$data['user_id'] = $request->user()->id;


Task::create($data);


return redirect()->route('tasks.index')->with('success', 'Task created');
}


public function show(Task $task)
{
$this->authorize('view', $task);
return Inertia::render('Tasks/Show', ['task' => $task]);
}


public function edit(Task $task)
{
$this->authorize('update', $task);
return Inertia::render('Tasks/Edit', ['task' => $task]);
}


public function update(Request $request, Task $task)
{
$this->authorize('update', $task);


$data = $request->validate([
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'status' => 'required|in:todo,in_progress,done',
]);


$task->update($data);


return redirect()->route('tasks.index')->with('success', 'Task updated');
}


public function destroy(Task $task)
{
$this->authorize('delete', $task);
$task->delete();


return redirect()->route('tasks.index')->with('success', 'Task deleted');
}
}
