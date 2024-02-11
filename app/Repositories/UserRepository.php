<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
        public function all(): array;

        public function find(int $id): User;

        public function create(array $data): User;

        public function update(array $data, User $user): User;

        public function delete(User $user): bool;
}
