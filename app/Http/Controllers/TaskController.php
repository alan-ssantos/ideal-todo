<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {
        $task_data = $request->validated();
        $task = $request->user()->tasks()->create($task_data);

        return new TaskResource($task);
    }
}
