<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Tasks/Index', [
             'tasks' => Task::query()->with('user')->get()
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * @param StoreTaskRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Task::create([
                'user_id'       => Auth::user()->id,
                'title'         => $validated['title'],
                'description'   => $validated['description']
        ]);

        return Redirect::route('tasks')->with('message', 'Task created!');
    }

    /**
     * @param int $task_id
     * @return Response
     */
    public function edit(int $task_id): Response
    {
        $task = Task::find($task_id);

        return Inertia::render('Tasks/Edit', [
            'task' => [
                'id'            => $task->id,
                'title'         => $task->title,
                'description'   => $task->description,
            ],
        ]);
    }

    /**
     * @param int $task_id
     * @param UpdateTaskRequest $request
     * @return RedirectResponse
     */
    public function update(int $task_id, UpdateTaskRequest $request): RedirectResponse
    {
        $task = Task::find($task_id);

        $task->update($request->validated());

        return Redirect::route('tasks')->with('message', 'Task updated!');
    }

    /**
     * @param int $task_id
     * @return RedirectResponse
     */
    public function destroy(int $task_id): RedirectResponse
    {
        $task = Task::find($task_id);

        $task->delete();

        return Redirect::route('tasks')->with('success', 'Task deleted.');
    }
}
