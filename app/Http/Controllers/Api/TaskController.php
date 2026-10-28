<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller 
{
    // Fungsi GET untuk menampilkan data dummy (Pertemuan 2)
    public function index() {
    $tasks = Task::all();
    return response()->json([
        'message' => 'Task berhasil ditampilkan',
        'data' => TaskResource::collection($task)
    ], 200);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $task = Task::create($validated);

    return response()->json([
        'message' => 'Task berhasil dibuat',
        'data' => new TaskResource($task)
    ],200);
}


    public function show($id){
        $task = Task::find($id);

        if(! $task) {
            return response()->json([
                'message'=> 'Task tidak ditemukan'
            ],404);
        } 
        
          return response()->json([
        'message' => 'Task berhasil dibuat',
        'data' => new TaskResource($task)
    ],200);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (! $task) {
            return response()->json([
                'message' => 'Task tidak ditemukan'
            ],404);
        }
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'sometimes|boolean',
        ]);
        $task->update($validated);

          return response()->json([
        'message' => 'Task berhasil diupdate',
        'data' => new TaskResource($task)
    ],200);

    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (! $task) {
            return response()->json([
                'message' => 'Task tidak ditemukan'
            ],404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task berhasil dihapus'
        ],200);
    }
}