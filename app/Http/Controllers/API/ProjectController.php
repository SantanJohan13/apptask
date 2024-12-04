<?php

namespace App\Http\Controllers\API;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        // dd($projects);
        return self::apiResponse(true, "projects retrieved successfully", $projects);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|string|max:50',
     
        ]);

        $project = new Project([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'user_id' =>1,
        ]);
        $project->save() ;

        return self::apiResponse(true, "Project created successfully", $project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $project = Project::find($id);

        if (!$project) {
            return self::apiResponse(false, "project not found", [], 404);
        }

        return self::apiResponse(true, "project retrieved successfully", $project);
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());
        
        return self::apiResponse(true, "Project updated successfully", $project);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->tasks()->delete();
        $project->delete();
        return self::apiResponse(true, "Projet deleted successfully", [], 204);
    }
}
