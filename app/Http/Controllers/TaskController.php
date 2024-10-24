<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = $this->taskService->createTask([
            'description' => $request->description,
            'status' => $request->status
        ]);

        if ($task) {
            return response()->json($task, 201);
        }

        return response()->json(['error' => 'Failed to create task'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $updatedTask = $this->taskService->updateTask($task, [
            'description' => $request->description,
            'status' => $request->status
        ]);

        return response()->json($updatedTask);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
     * Get all tasks that are marked as done.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllDoneTasks()
    {
        $tasks = $this->taskService->getAllDoneTasks();
        return response()->json($tasks);
    }

    /**
     * Get all tasks that are in progress.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllInProcessTasks()
    {
        $tasks = $this->taskService->getAllInProcessTasks();
        return response()->json($tasks);
    }

    /**
     * Get all tasks that are not done.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllToDoTasks()
    {
        $tasks = $this->taskService->getAllToDoTasks();
        return response()->json($tasks);
    }
}
