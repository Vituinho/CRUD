<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Tasks::all();

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
        $tasks = Tasks::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->boolean('status')

           /* Esses $request->input/boolean serve para marcar ele, mesmo for null ele mostra como o valor que é, mostrando se é boolean e tals, e isso faz o status funcionar pq manda o false caso não esteja marcado */ 
        ]);

        if($tasks) {
            return redirect()->route('tasks.index')->with('success', 'Tarefa cadastrado com sucesso!');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Não foi possível cadastrar a tarefa!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tasks $tasks)
    {
        //
    }
}
