<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteFormRequest;
use App\Models\Note;
use App\Repositories\NoteRepository;

class NotesController extends Controller
{
    public function __construct(private NoteRepository $repository)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = $this->repository->all();

        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteFormRequest $request)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $note = $this->repository->create($data);

        $json = [
            'data' => $note,
        ];

        if (!$note) {
            $json['message'] = __('messages.max_items', ['max' => Note::$maxNotes, 'item' => __('messages.attributes.note')]);
        } else {
            $json['message'] = __('messages.created', ['item' => __('messages.attributes.note')]);
        }

        return response()->json($json, 201);
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
        $note = $this->repository->find($id);

        return view('notes.edit')->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteFormRequest $request, Note $note)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $note = $this->repository->update($data, $note);

        return response()->json([
            'message' => __('messages.updated', ['item' => __('messages.attributes.note')]),
            'data' => $note,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->repository->delete($note);

        return response()->json([
            'message' => __('messages.deleted', ['item' => __('messages.attributes.note')]),
            'note' => $note->id
        ]);
    }
}
