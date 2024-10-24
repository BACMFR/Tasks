<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks()
    {
        $tasks = Task::all();
        return [
            'success' => true,
            'message' => 'found successfully',
            'data' => $tasks
        ];
    }

    public function createTask($data)
    {
        $task = Task::create([
            'description' => $data['description'],
            'status' => $data['status']
        ]);

        if ($task) {
            return [
                'success' => true,
                'message' => 'Task created successfully',
                'data' => $task
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to create task'
        ];
    }

    public function updateTask(Task $task, $data)
    {
        $task->update([
            'description' => $data['description'],
            'status' => $data['status']
        ]);

        return [
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task
        ];
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return [
            'success' => true,
            'message' => 'Task deleted successfully'
        ];
    }

    public function getAllDoneTasks()
    {
        $tasks = Task::where('status', 'is-done')->get();
        return [
            'success' => true,
            'message' => 'All done Tasks',
            'data' => $tasks
        ];
    }

    public function getAllInProcessTasks()
    {
        $tasks = Task::where('status', 'in-progress')->get();
        return [
            'success' => true,
            'message' => 'All in Process Tasks',
            'data' => $tasks
        ];
    }

    public function getAllToDoTasks()
    {
        $tasks = Task::where('status', 'todo')->get();
        return [
            'success' => true,
            'message' => 'All to do Tasks',
            'data' => $tasks
        ];
    }
}
