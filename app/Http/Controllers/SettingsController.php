<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SettingsRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\App;

class SettingsController extends Controller
{
    public function __construct(private SettingsRepository $repository)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modals.settings')->with('settings', Auth::user()->settings);
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
    public function show(string $any)
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
    public function update(SettingsFormRequest $request)
    {
        $data = $request->validated();

        $previousLanguage = Auth::user()->settings->language;
        $previousTheme = Auth::user()->settings->theme;

        $settings = $this->repository->update($data, Auth::user()->settings);

        if (!$settings->wasChanged()) {
            return response()->json([
                'message' => __('messages.no_changes'),
            ]);
        }

        session('user')->settings = $settings;

        if ($previousLanguage !== $settings->language) {
            App::setLocale($settings->language);
        }

        return response()->json([
            'message' => __('messages.updated_successfully', ['item' => __('messages.attributes.settings')]),
            'data' => $request->except(['_token', '_method']),
            'reload' => $previousLanguage !== $settings->language,
            'theme' => $previousTheme !== $settings->theme ? asset('css/themes/theme-' . $settings->theme . '.css') : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function theme(SettingsFormRequest $request)
    {
        $data = $request->validated();

        $settings = $this->repository->update($data, Auth::user()->settings);

        if (!$settings->wasChanged()) {
            return response()->json([
                'message' => __('messages.no_changes'),
            ]);
        }

        session('user')->settings = $settings;

        return response()->json([
            'message' => __('messages.updated_successfully', ['item' => __('messages.attributes.settings')]),
            'data' => $request->except(['_token', '_method']),
            'theme' => asset('css/themes/theme-' . $settings->theme . '.css'),
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
