<?php

namespace App\Http\Controllers;
use App\Models\tasks;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // FUNCIONES TASK
    public function create() {
        $data['tasks'] = tasks::all();
        $data['comments'] = comments::all();
        return view('front/main', $data);
    }

    public function create_ajax($task_id=null){
        $data['tasks'] = tasks::all();
        $data['comments'] = comments::all();
        $returnHtml = view('front/main', $data);
        return response()->json(['task_id'=>$task_id, 'html'=>$returnHtml]);
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
            $request->session()->flash('alert-success', 'Task was successful added!');
            return $this->create_ajax(DB::table('tasks')->latest('id')->first()->id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() ], 500);
        }
    }

    public function edit_task(Request $request, $id){
        $task = tasks::find($id);
        if (!$task) {
            $request->session()->flash('alert-success', 'Un error ocurrió');
        } else {
            try {
                $request->validate([
                    'title' => 'required|string',
                    'desc' => 'required|string',
                    'color' => 'required|integer',
                    'solved' => 'required|boolean',
                    'position' => 'required|integer',
                ]);
                $task->title = $request->input('title');
                $task->desc = $request->input('desc');
                $task->color = $request->input('color');
                $task->solved = $request->input('solved');
                $task->position = $request->input('position');
                $task->update();
                $request->session()->flash('alert-success', 'Task was successful edited');
                return $this->create_ajax($id);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage() ], 500);
            }
        } 
        return $this->create();
    }

    public function delete_task($id){
        $task = tasks::find($id);
        if (!$task) {
            $request->session()->flash('alert-danger', 'Un error ocurrió');
            // return response()->json(['error' => 'Tarea no encontrada'], 404);
        } else {
            $task->delete();
            return $this->create();
        }
    }
    //FUNCIONES COMMENTS
    // public function show_comments($id){
    //     $data['comments'] = DB::table('comments')->where('tasks_id', $id)->get();
    //     return view('front/main', $data);
    //     // return $data;
    // }
    // public function select_one_comment($id){
    //     $comment = comments::find($id);
    //     return $comment;
    // }
    public function store_comment(Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'desc' => 'required|string',
                'tasks_id' => 'required|integer',
            ]);

            $comment = new comments();
            $comment->title = $request->input('title');
            $comment->desc = $request->input('desc');
            $comment->tasks_id = $request->input('tasks_id');
            $comment->save();
            $request->session()->flash('alert-success', 'Comentario añadido');
            return $this->create();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Un error ocurrió'], 500);
        }
    }
    public function delete_comment($id){
        $comment = comments::find($id);
        if (!$comment) {
            return response()->json(['error' => 'TONTO'], 404);
        } else {
            $comment->delete();
        }
        return response()->json(['msj' => 'Comentario eliminado'], 200);
    }
}
