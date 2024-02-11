<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class EloquentTagRepository implements TagRepository
{
        public function all(): array
        {
                return Tag::all()->toArray();
        }

        public function find(int $id): Tag
        {
                return Tag::find($id);
        }

        public function create(array $data): Tag
        {
                $data['user_id'] = Auth::id();

                $tag = Tag::create($data);

                return $tag;
        }

        public function update(array $data, Tag $tag): Tag
        {
                $tag->update($data);

                // $tag->fill($data)->save();

                return $tag;
        }

        public function delete(Tag $tag): bool
        {
                return $tag->delete();
        }
}
