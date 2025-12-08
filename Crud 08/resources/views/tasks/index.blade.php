
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success mt-2 container justify-content-center" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger mt-2 container justify-content-center" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <div class="d-flex justify-content-between align-items-center my-5 container">
        <h1>Minhas Tarefas</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Criar</a>
    </div>

    

    @if(count($tasks) == 0)
        <p class="d-flex justify-content-center">Nenhuma tarefa cadastrada</p>
    @else 

        <div class="container">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if($task->status === false)
                                    Pendente
                                @else 
                                    Concluída
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Editar</a>
                                
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf @method('DELETE')

                                        <button onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')" class="btn btn-danger">Deletar</button>
                                    </form>
                                </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>