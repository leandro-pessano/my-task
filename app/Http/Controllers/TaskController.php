<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Task;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user=Auth::id();
        $tasks = Task::where('user_id', $id_user)->get();

        $data = [
            "tasks" => $tasks
        ];

        return view('task', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required|unique:tasks|max:80',
            'content' => 'required'
        ]);

        $newTask = new Task();

        $newTask->fill($data);
        $newTask->user_id = Auth::id();
        
        $newTask->save();

        return redirect()->route('task.index')->with('status', 'Task aggiunta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $data = [
            'task' => $task
        ];
        return view('task', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $data = [
            'task' => $task
        ];
        return view('task', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        $request->validate([
            'title' => ['required',
            Rule::unique('tasks')->ignore($task),'max:80'],
            'content' => 'required'
        ]);

        $task->update($data);

        return redirect()->route('task.index')->with('status', 'Task modificata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')->with('status', 'Task eliminata');
    }
}
