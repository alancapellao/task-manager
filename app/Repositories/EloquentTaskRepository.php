<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EloquentTaskRepository implements TaskRepository
{
        public function all(): array
        {
                $tasks = [];

                $statusData = Task::$status;

                $pageSize = Task::$page;

                foreach ($statusData as $i => $status) {
                        $data = Task::with('lista', 'tags')
                                ->formattedDueDate()
                                ->where('status', $i)
                                ->paginate($pageSize);

                        $tasks[$status]['tasks'] = $data->toArray();
                }

                return $tasks;
        }

        public function search(array $params): array
        {
                $tasks = [];

                $statusData = Task::$status;

                $pageSize = Task::$page;

                $index = $params['index'] ?? null;
                $column = $params['column'] ?? null;
                $list = $params['list'] ?? null;
                $search = $params['search'] ?? null;

                if (in_array($column, array_values($statusData))) {

                        $statusData = array_filter($statusData, function ($status) use ($column) {
                                return $status == $column;
                        });
                }

                foreach ($statusData as $i => $status) {
                        $query = Task::with('lista', 'tags')->formattedDueDate();

                        if ($column) {
                                $query->where('status', array_search($column, $statusData));
                        }

                        if ($list) {
                                $query->where('lista_id', $list);
                        }

                        if ($search) {
                                $query->where(function ($query) use ($search) {
                                        $query->where('title', 'like', "%$search%")
                                                ->orWhere('description', 'like', "%$search%");
                                });
                        }

                        $tasks[$status]['tasks'] = $query->where('status', $i)
                                // ->get()
                                // ->slice($index, $pageSize)
                                ->paginate($pageSize, ['*'], 'index', $index)
                        // ->values()
                        ->toArray();

                        // $tasks[$status]['quantity'] = $query->where('status', $i)->count();
                }

                return $tasks;
        }

        public function find(int $id): Task
        {
                return Task::with('tags', 'lista')->find($id);
        }

        public function create(array $data): Task
        {
                $data['user_id'] = Auth::id();

                if (isset($data['list'])) {
                        $data['lista_id'] = $data['list'];
                }

                $task = Task::create($data);

                if (isset($data['tags'])) {
                        $this->syncTags($task, $data['tags']);
                }

                return $task;
        }

        public function update(array $data, Task $task): Task
        {
                if (isset($data['list'])) {
                        $data['lista_id'] = $data['list'];
                }

                $task->update($data);

                // $Task->fill($data)->save();

                if (isset($data['tags'])) {
                        $this->syncTags($task, $data['tags']);
                }

                return $task->load('tags', 'lista');
        }

        public function delete(Task $task): bool
        {
                return $task->delete();
        }

        protected function syncTags(Task $task, array $tags): void
        {
                $task->tags()->detach();

                $task->tags()->sync($tags);

                // $data = [];

                // foreach ($tags as $tagId) {
                //         $data[] = [
                //                 'task_id' => $task->id,
                //                 'tag_id' => $tagId
                //         ];
                // }

                // TaskTag::insert($data);
        }
}
