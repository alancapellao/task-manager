<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFormRequest;
use App\Models\Tag;
use App\Repositories\TagRepository;

class TagsController extends Controller
{
    public function __construct(private TagRepository $repository)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagFormRequest $request)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $tag = $this->repository->create($data);

        return response()->json([
            'message' => __('messages.created', ['item' => __('messages.attributes.tag')]),
            'data' => $tag,
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
        $tag = $this->repository->find($id);

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagFormRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $tag = $this->repository->update($data, $tag);

        return response()->json([
            'message' => __('messages.updated', ['item' => __('messages.attributes.tag')]),
            'data' => $tag,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->repository->delete($tag);

        return response()->json([
            'message' => __('messages.deleted', ['item' => __('messages.attributes.tag')]),
            'tag' => $tag->id
        ]);
    }
}
