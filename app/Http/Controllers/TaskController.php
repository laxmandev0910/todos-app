<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return response()->json(['data' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {

        try {
            $task = Task::create($request->validated());

            return response()->json(['message' => 'Task created successfully', 'data' => $task]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // 23000 is the error code for duplication errors
                return response()->json(['error' => 'Task name already exists'], 422);
            } else {
                // Handle other types of query exceptions
                return response()->json(['error' => 'Something went wrong'], 500);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return response()->json(['message' => 'Task updated successfully', 'data' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
