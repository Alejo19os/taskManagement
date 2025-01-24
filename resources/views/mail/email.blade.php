<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea Notificación</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">

        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="color: #333; font-size: 24px; margin: 0;">
                @if ($task->completed)
                    Tarea Completada: 
                @else
                    Nueva Tarea Creada:
                @endif
            </h1>
        </div>

        <div style="font-size: 16px; color: #555;">
            <p>Hola,</p>

            @if ($task->completed)
                <p>La tarea <strong>"{{ $task->title }}"</strong> ha sido marcada como completada.</p>
            @else
                <p>Nuea tare asignada<strong>"{{ $task->title }}"</strong>.</p>
            @endif

            <div style="background-color: #f9f9f9; border-left: 4px solid #007bff; padding: 10px 15px; margin: 15px 0;">
                <p><strong>Descripción:</strong> {{ $task->description }}</p>
                <p><strong>Fecha de Vencimiento:</strong> {{ $task->due_date }}</p>
            </div>
        </div>
    </div>

</body>

</html>
