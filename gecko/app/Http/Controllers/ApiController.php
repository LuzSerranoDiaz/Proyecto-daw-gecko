<?php

namespace App\Http\Controllers;
use App\Models\tasks;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // FUNCIONES TASK
    // public function show_tasks(){
    //     $tasks = tasks::all();
    //     return response()->json($tasks);
    // }
    public function create() {
        $data['tasks'] = tasks::all();
        return view('front/main', $data);
    }
    // public function select_one_task($id){
    //     $task = tasks::find($id);
    //     return ;
    // }
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
            $request->session()->flash('alert-success', 'Task was successful added!');
            return $this->create();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() ], 500);
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
    public function show_comments($id){
        $data['comments'] = DB::table('comments')->where('task_id', $id)->get();
        return $data;
    }
    // public function select_one_comment($id){
    //     $comment = comments::find($id);
    //     return $comment;
    // }
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
