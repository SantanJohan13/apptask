<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $project = Project::find($id);
        $tasks = $project->tasks;
        return self::apiResponse(true, "tasks retrieved successfully", $tasks);
    }


    public static function apiResponse($success, $message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'body' => $data
        ], $status);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateTaskRequest $request)
    {
        Task::create($request->validated());
        return self::apiResponse(true, "Task created successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId, $taskId)
    {
         $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        return self::apiResponse(true, "Task retrieved successfully", $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $projectId, $taskId)
    {
         $request->validate([
            'status' => 'required|in:non commencé,en cours,terminé',
            'priority' => 'required|in:basse,moyenne,haute',
        ]);

        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        $task->update($request->all());
        return self::apiResponse(true, "Task updated successfully", $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = $project->tasks()->findOrFail($taskId);
        $task->delete();
        return self::apiResponse(true, "Task deleted successfully", $project, 204);
    }
}
