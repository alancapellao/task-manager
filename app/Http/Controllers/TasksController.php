<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskFormRequest;
use App\Repositories\ListaRepository;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;

class TasksController extends Controller
{
    public function __construct(private TaskRepository $repository, private ListaRepository $listaRepository, private TagRepository $tagRepository)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->repository->all();

        return view('dashboard', [
            'title' => 'Dashboard',
            'tasks' => $tasks,
        ]);
    }

    public function search(TaskFormRequest $request)
    {
        $data = $request->validated();

        $tasks = $this->repository->search($data);

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lists = $this->listaRepository->all();
        $tags = $this->tagRepository->all();

        return view('tasks.create')->with([
            'lists' => $lists,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request)
    {
        $data = $request->validated();

        $task = $this->repository->create($data);

        return response()->json([
            'message' => __('messages.created', ['item' => __('messages.attributes.task')]),
            'data' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = $this->repository->find($id);
        $lists = $this->listaRepository->all();
        $tags = $this->tagRepository->all();

        return view('tasks.edit')->with([
            'task' => $task,
            'lists' => $lists,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskFormRequest $request, Task $task)
    {
        $data = $request->validated();

        $task = $this->repository->update($data, $task);

        return response()->json([
            'message' => __('messages.updated', ['item' => __('messages.attributes.task')]),
            'data' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->repository->delete($task);

        return response()->json([
            'message' => __('messages.deleted', ['item' => __('messages.attributes.task')]),
            'data' => $task->id,
        ]);
    }
}
