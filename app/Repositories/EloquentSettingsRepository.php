<?php

namespace App\Repositories;

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class EloquentSettingsRepository implements SettingsRepository
{
        // public function all(): array
        // {
        //         return Settings::all()->toArray();
        // }

        public function find(int $id): Settings
        {
                return Settings::find($id);
        }

        public function create(array $data): Settings
        {
                $data['user_id'] = Auth::id();

                // $settings->fill($request->all())->save();

                return Settings::create($data);
        }

        public function update(array $data, Settings $settings): Settings
        {
                // $settings->update($data);

                $settings->fill($data)->save();

                return $settings;
        }

        // public function delete(Settings $settings): bool
        // {
        //         return $settings->delete();
        // }
}
