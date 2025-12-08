<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TasksRequest $request)
    {
        $tasks = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->boolean('status')

           /* Esses $request->input/boolean serve para marcar ele, mesmo for null ele mostra como o valor que é, mostrando se é boolean e tals, e isso faz o status funcionar pq manda o false caso não esteja marcado */ 
        ]);

        if($tasks) {
            return redirect()->route('tasks.index')->with('success', 'Tarefa cadastrada com sucesso!');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Não foi possível cadastrar a tarefa!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TasksRequest $request, Task $task)
    {
        $update = $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->boolean('status')
        ]);

        if($update) {
            return redirect()->route('tasks.index')->with('success', 'Tarefa editada com sucesso!');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Não foi possível editar a tarefa!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $deletou = $task->delete();

        if ($deletou) {
            return redirect()->route('tasks.index')->with('success', 'Tarefa removida com sucesso!!');
        }
        else {
            return redirect()->route('tasks.index')->with('error', 'Não foi possível remover essa tarefa!!');
        }
    }
}
