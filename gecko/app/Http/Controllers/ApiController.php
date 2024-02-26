<?php

namespace App\Http\Controllers;
use App\Models\tasks;
use App\Models\comments;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // FUNCIONES TASK
    public function show_tasks(){
        $tasks = tasks::all();
        return response()->json($tasks);
    }
    public function select_one_task($id){
        $task = tasks::find($id);
        return $task;
    }
    public function store_task(Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'desc' => 'required|string',
                'color' => 'required|integer',
                'solved' => 'required|boolean',
                'position' => 'required|integer',
            ]);

            $task = new tasks();
            $task->title = $request->input('title');
            $task->desc = $request->input('desc');
            $task->color = $request->input('color');
            $task->solved = $request->input('solved');
            $task->position = $request->input('position');
            $task->save();
            return response()->json(['msj' => 'tarea guardada'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'CAGASTE'], 500);
        }
    }
    public function delete_task($id){
        $task = tasks::find($id);
        if (!$task) {
            return response()->json(['error' => 'TONTO'], 404);
        } else {
            $task->delete();
        }
        return response()->json(['msj' => 'Tarea eliminada'], 200);
    }
    //FUNCIONES COMMENTS
    public function show_comments(){
        $comments = comments::all();
        return response()->json($comments);
    }
    public function select_one_comment($id){
        $comment = comments::find($id);
        return $comment;
    }
    public function store_comment(Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'desc' => 'required|string',
                'task_id' => 'required|integer',
            ]);

            $comment = new comments();
            $comment->title = $request->input('title');
            $comment->desc = $request->input('desc');
            $comment->task_id = $request->input('task_id');
            $comment->save();
            return response()->json(['msj' => 'comentario guardado'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'CAGASTE'], 500);
        }
    }
    public function delete_comment($id){
        $comment = comments::find($id);
        if (!$comment) {
            return response()->json(['error' => 'TONTO'], 404);
        } else {
            $comment->delete();
        }
        return response()->json(['msj' => 'COmentario eliminado'], 200);
    }
}
