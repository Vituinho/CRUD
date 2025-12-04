<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Minhas tarefas</h1>

    @if(count($tasks) == 0)
        <p>Nenhuma tarefa cadastrada</p>
    @else 
        <ul>
            @foreach($tasks as $task)
            <li>{{ $task->title ?? 'Sem título' }}</li>
            <li>{{ $task->description ?? 'Sem descrição' }}</li>
            <li>
                @if($task->status) === false
                    Tarefa Pendente
                @else 
                    Tarefa Concluida
                @endif
           </li>
            @endforeach
        </ul>
    @endif
    
</body>
</html>