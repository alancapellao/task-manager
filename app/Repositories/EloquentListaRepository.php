<?php

namespace App\Repositories;

use App\Models\Lista;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class EloquentListaRepository implements ListaRepository
{
        public function all(): array
        {
                return Lista::all()->toArray();
        }

        public function find(int $id): Lista
        {
                // $tasks = [];

                // $statusData = Task::$status;

                // $pageSize = Lista::$page;

                // foreach ($statusData as $i => $status) {
                //         $data = Lista::with(['tasks' => function ($query) use ($i, $pageSize) {
                //                 $query->with('lista', 'tags')->formattedDueDate()
                //                         ->where('status', $i)
                //                         ->paginate($pageSize);
                //         }]);

                //         $tasks[$status]['tasks'] = $data->toArray();
                // }

                // return $tasks;

                return Lista::find($id);
        }

        public function create(array $data): Lista
        {
                $data['user_id'] = Auth::id();

                $list = Lista::create($data);

                return $list;
        }

        public function update(array $data, Lista $list): Lista
        {
                $list->update($data);

                // $list->fill($data)->save();

                return $list;
        }

        public function delete(Lista $list): bool
        {
                return $list->delete();
        }
}
