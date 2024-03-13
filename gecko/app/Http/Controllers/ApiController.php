<?php

namespace App\Http\Controllers;
use App\Models\tasks;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public const TASK_NOT_SOLVED = 0;
    public const TASK_SOLVED = 1;
    public const DEFAULT_POSITION = 1;
    // FUNCIONES TASK
    public function create() {
        $data['tasks'] = tasks::all()->sortDesc();
        $data['comments'] = comments::all()->sortDesc();
        return view('front/main', $data);
    }

    public function create_ajax($task_id=null, $comment_id=null){
        $data['tasks'] = tasks::all()->sortDesc();
        $data['comments'] = comments::all()->sortDesc();
        $returnHtml = view('front/main', $data);
        return response()->json(['task_id'=>$task_id, 'comment_id'=>$comment_id, 'html'=>$returnHtml]);
    }

    public function store_task(Request $request){
        try {
            $request->validate([
                'title' => 'required|string',
                'desc' => 'required|string',
                'color' => 'required|integer'
            ]);

            $task = new tasks();
            $task->title = $request->input('title');
            $task->desc = $request->input('desc');
            $task->color = $request->input('color');
            $task->solved = self::TASK_NOT_SOLVED;
            $task->position = self::DEFAULT_POSITION;
            $task->save();
            $request->session()->flash('alert-success', 'Task was successful added!');
            return $this->create_ajax(DB::table('tasks')->latest('id')->first()->id, null);
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
                    'color' => 'required|integer'
                ]);
                $task->title = $request->input('title');
                $task->desc = $request->input('desc');
                $task->color = $request->input('color');
                $task->update();
                $request->session()->flash('alert-success', 'Task was successful edited');
                return $this->create_ajax($id, null);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage() ], 500);
            }
        } 
        return $this->create();
    }

    public function delete_task(Request $request, $id){
        $task = tasks::find($id);
        if (!$task) {
            $request->session()->flash('alert-danger', 'Un error ocurrió');
            // return response()->json(['error' => 'Tarea no encontrada'], 404);
        } else {
            $task->delete();
            $request->session()->flash('alert-success', 'Se ha eliminado correctamente.');
            return $this->create();
        }
    }

    public function solve_task(Request $request, $id){
        $task = tasks::find($id);
        if (!$task) {
            $request->session()->flash('alert-danger', 'Un error ocurrió');
        }
        $task->solved = ($task->solved === self::TASK_NOT_SOLVED) ? self::TASK_SOLVED : self::TASK_NOT_SOLVED;
        $task->save();
        $request->session()->flash('alert-success', 'Se ha cambiado el estado correctamente.');
        return $this->create();
    }

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
            return $this->create_ajax(null, DB::table('comments')->latest('id')->first()->id);
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
