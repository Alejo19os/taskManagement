@extends('layouts.app')

@section('template_title')
    {{ __('Tareas') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Tareas') }}
                        </span>

                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal">
                                {{ __('Crear nueva tarea') }}
                            </button>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4" id="success-alert">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table id="tasksTable" class="table table-striped table-hover">
                            <thead class="table">
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha de vencimiento</th>
                                    <th>Completado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="taskSwitch{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}
                                                    onchange="confirmMarkCompleted('{{ route('tasks.markCompleted', $task) }}', this)">
                                                <label class="form-check-label" for="taskSwitch{{ $task->id }}">
                                                    {{ $task->completed ? 'Completada' : 'Pendiente' }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">{{ __('Nueva Tarea') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tasks.store') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    @include('task.form')
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tasksTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            order: [[2, 'asc']], 
        });

        var alertElement = document.getElementById('success-alert');
        if (alertElement) {
            setTimeout(function () {
                alertElement.style.transition = "opacity 0.5s ease";
                alertElement.style.opacity = "0"; 
                setTimeout(() => alertElement.remove(), 500); 
            }, 5000); 
        }
    });

    function confirmMarkCompleted(url, switchElement) {
        const isChecked = switchElement.checked;
        const confirmationMessage = isChecked
            ? "¿Estás seguro de marcar esta tarea como completada?"
            : "¿Estás seguro de desmarcar esta tarea como completada?";

        if (confirm(confirmationMessage)) {
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ completed: isChecked })
            })
                .then(response => {
                    if (response.ok) {
                        alert("El estado de la tarea se ha actualizado correctamente.");
                        location.reload();
                    } else {
                        throw new Error("Ocurrió un error al actualizar la tarea.");
                    }
                })
                .catch(error => {
                    alert(error.message);
                    switchElement.checked = !isChecked;
                });
        } else {
            switchElement.checked = !isChecked;
        }
    }
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
