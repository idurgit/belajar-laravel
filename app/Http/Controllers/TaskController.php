<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        if  ($request->search) {
            $tasks = Task::where('task', 'LIKE', "%$request->search%")
                ->get();

            return $tasks;
        }

        $tasks = Task::all();
        return $tasks;
    }

    public function store(Request $request)
    {
        Task::create([
            'task' => $request->task,
            'user' => $request->user
        ]);
        
        return 'success';
    }
    
    public function show($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        
    }

    public function update(Request $request, $id)
    {
        $task = DB::table('tasks')->where('id', $id)->update([
            'task' => $request->task,
            'user' => $request->user
        ]);

        return 'success';
    }

    public function destroy($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->delete();

        return 'success';
    }
}
