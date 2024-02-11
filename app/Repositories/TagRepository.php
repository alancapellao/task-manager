<?php

namespace App\Repositories;

use App\Models\Tag;

interface TagRepository
{
        public function all(): array;

        public function find(int $id): Tag;

        public function create(array $data): Tag;

        public function update(array $data, Tag $tag): Tag;

        public function delete(Tag $tag): bool;
}
