<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserFormRequest;
use App\Repositories\UserRepository;

class UsersController extends Controller
{
    public function __construct(private UserRepository $repository)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('modals.profile')->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request)
    {
        $data = $request->validated();

        $data = $request->except('_token', '_method');

        $user = $this->repository->update($data, Auth::user());

        if (!$user->wasChanged()) {
            return response()->json([
                'message' => __('messages.no_changes'),
            ]);
        }

        session('user')->fill($user->toArray());

        return response()->json([
            'message' => __('messages.updated_successfully'),
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
