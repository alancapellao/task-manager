<?php

namespace App\Repositories;

use App\Models\Lista;

interface ListaRepository
{
        public function all(): array;

        public function find(int $id): Lista;

        public function create(array $data): Lista;

        public function update(array $data, Lista $list): Lista;

        public function delete(Lista $list): bool;
}
