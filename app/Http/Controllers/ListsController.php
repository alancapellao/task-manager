<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListaFormRequest;
use App\Models\Lista;
use App\Repositories\ListaRepository;
use App\Repositories\TaskRepository;

class ListsController extends Controller
{

    public function __construct(private ListaRepository $repository)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = $this->repository->all();

        return view('lists.index')->with('lists', $lists);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListaFormRequest $request)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $list = $this->repository->create($data);

        return response()->json([
            'message' => __('messages.created', ['item' => __('messages.attributes.list')]),
            'data' => $list,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, TaskRepository $taskRepository)
    {
        $list = $this->repository->find($id);

        $tasks = $taskRepository->search(['list' => $id]);

        return view('lists.index')->with([
            'list' => $list,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $list = $this->repository->find($id);

        return view('lists.edit')->with('list', $list);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListaFormRequest $request, Lista $list)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $list = $this->repository->update($data, $list);

        return response()->json([
            'message' => __('messages.updated', ['item' => __('messages.attributes.list')]),
            'data' => $list,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lista $list)
    {
        $this->repository->delete($list);

        return response()->json([
            'message' => __('messages.deleted', ['item' => __('messages.attributes.list')]),
            'redirect' => route('dashboard'),
        ]);
    }
}
