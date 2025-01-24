<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Mail\TaskNotificationMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date', 'asc')
            ->paginate(10);

        return view('task.index', compact('tasks'))
            ->with('i', ($request->input('page', 1) - 1) * $tasks->perPage());
    }

    public function create(): View
    {
        $task = new Task();

        return view('task.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        $subjectLine = 'Nueva Tarea Asignada';

        Mail::to($task->user->email)->send(new TaskNotificationMail($task, $subjectLine));

        return Redirect::route('tasks.index')
            ->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $task = Task::find($id);

        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $task = Task::find($id);

        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);


        return Redirect::route('tasks.index')
            ->with('success', 'Tarea actualizada exitosamente');
    }
    
    public function markCompleted(Request $request, Task $task)
    {
        $request->validate([
            'completed' => 'required|boolean',
        ]);

        $task->update(['completed' => $request->completed]);

        if ($request->completed) {
            $subjectLine = 'Tu tarea se ha completada';
            Mail::to($task->user->email)->send(new TaskNotificationMail($task, $subjectLine));
        }

        return response()->json(['message' => 'Tarea actualizada exitosamente.'], 200);
    }

}
