<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

        // Create a task
        public function store(Request $request)
        {
            // Use Validator instead of $request->validate()
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:tasks',
                'description' => 'nullable',
                'due_date' => 'required|date|after:today',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Create a task
            $task = Task::create($request->all());

            return response()->json($task, 201);
        }

        // Update a task
        public function update(Request $request, $id)
        {
            $task = Task::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:tasks,title,' . $task->id,
                'description' => 'nullable',
                'status' => 'in:pending,completed',
                'due_date' => 'required|date|after:today',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Update the task
            $task->update($request->all());

            return response()->json($task);
        }

    // Get all tasks with optional filters
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('status')) {
            $tasks->where('status', $request->status);
        }

        if ($request->has('due_date')) {
            $tasks->where('due_date', $request->due_date);
        }

        return response()->json($tasks->paginate(10));
    }

    // Get a specific task
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
