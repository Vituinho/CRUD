<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex justify-content-between align-items-center my-5 container">
        <h1>Editar Tarefas</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Voltar</a>
    </div>
    
    

    <div class="container">
        <form action="{{ route('tasks.update', $task) }}" method="POST">

            @csrf @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input 
                type="checkbox"
                class="form-check-input"
                id="status" 
                name="status" 
                {{ $task->status ? 'checked' : '' }}
                >
                <label class="form-check-label" for="status">Concluída</label>
            </div>
            <button type="submit" class="btn btn-primary">Editar Tarefa</button>
        </form>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>