<?php

namespace App\Repositories;

use App\Models\Settings;

interface SettingsRepository
{
        // public function all(): array;

        public function find(int $id): Settings;

        public function create(array $data): Settings;

        public function update(array $data, Settings $list): Settings;

        // public function delete(Settings $list): bool;
}
