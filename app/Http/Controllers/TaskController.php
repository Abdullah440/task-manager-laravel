<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $tasks = Task::orderBy('sort_order')->get();
        return view('tasks.index', compact('tasks'));
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
    public function store(Request $request){
        Task::create($request->only('title', 'description', 'status'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task){
        $task->update($request->only('status'));

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task){
        $task->delete();
        return back();
    }

    public function updateOrder(Request $request) {
        foreach ($request->order as $index => $taskId) {
            Task::where('id', $taskId)->update(['sort_order' => $index]);
        }
        return response()->json(['status' => 'success']);
    }
}
