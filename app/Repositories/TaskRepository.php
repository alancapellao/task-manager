<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepository
{
        public function all(): array;

        public function search(array $params): array;

        public function find(int $id): Task;

        public function create(array $data): Task;

        public function update(array $data, Task $task): Task;

        public function delete(Task $task): bool;

        // public function syncTags(Task $task, array $tags): void;
}
