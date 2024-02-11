<?php

namespace App\Repositories;

use App\Models\Note;

interface NoteRepository
{
        public function all(): array;

        public function find(int $id): Note;

        public function create(array $data): Note|bool;

        public function update(array $data, Note $note): Note;

        public function delete(Note $note): bool;
}
