<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {
        $task_data = $request->validated();
        $task = $request->user()->tasks()->create($task_data);

        return new TaskResource($task);
    }

    public function index(Request $request)
    {
        $tasks = $request->user()->tasks;

        return TaskResource::collection($tasks);
    }

    public function show(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $task->delete();

        return response()->noContent();
    }
}
