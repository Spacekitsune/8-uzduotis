<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Owner;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::all();
        return view('task.index', ['tasks' => $task]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::all();
        return view('task.create', ['owners' => $owner]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            "task_title" => ['required', 'alpha', 'min:6', 'max:225'],
            "task_description" => ['required',  'max:1500'],
            "task_startDate" => ['required', 'date'],
            "task_endDate" => ['required', 'date', 'after_or_equal: task_startDate' ],
            "task_logo" => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif' ],
            "task_ownerId" => ['required', 'integer', 'gt:0' ],
        ]);

        $task = new Task;

        if($request->has('task_logo')) {
        $imageName = 'image' . time().'.'.$request->task_logo->extension();
        $request->task_logo->move(public_path('images') , $imageName);
        $task->logo = $imageName;
        } else {
            $task->logo = "No image";  
        }

       
        $task->title = $request->task_title;
        $task->description = $request->task_description;
        $task->start_date = $request->task_startDate;
        $task->end_date = $request->task_endDate;            
        $task->owner_id = $request->task_ownerId;

        $task->save();

        return redirect()->route('task.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $owner = Owner::all();
        return view('task.edit', ['task' => $task, 'owners' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        
        $request->validate([

            "task_title" => ['required', 'alpha', 'min:6', 'max:225'],
            "task_description" => ['required',  'max:1500'],
            "task_startDate" => ['required', 'date'],
            "task_endDate" => ['required', 'date', 'after_or_equal: task_startDate' ],
            "task_logo" => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif' ],
            "task_ownerId" => ['required', 'integer', 'gt:0' ],
        ]);

        if($request->has('task_logo')) {
            $imageName = 'image' . time().'.'.$request->task_logo->extension();
            $request->task_logo->move(public_path('images') , $imageName);
            $task->logo = $imageName;
        }

        $task->title = $request->task_title;
        $task->description = $request->task_description;
        $task->start_date = $request->task_startDate;
        $task->end_date = $request->task_endDate;
        $task->owner_id = $request->task_ownerId;

        $task->save();

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->logo!='No image') {
        $dir = "images";
        unlink($dir.'/'.$task->logo);
        }
        $task->delete();
        return redirect()->route('task.index')->with('success_message', 'Task was deleted.');
    
    }
}
