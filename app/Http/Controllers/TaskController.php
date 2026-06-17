<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
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

    public function index(Request $request){
        $tasks = $request->user()->tasks;

        return TaskResource::collection($tasks);
    }
}
