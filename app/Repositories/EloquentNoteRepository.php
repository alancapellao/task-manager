<?php

namespace App\Repositories;

use App\Models\Note;
use App\Repositories\NoteRepository;
use Illuminate\Support\Facades\Auth;

class EloquentNoteRepository implements NoteRepository
{
        public function all(): array
        {
                return Note::all()->toArray();
        }

        public function find(int $id): Note
        {
                return Note::find($id);
        }

        public function create(array $data): Note|bool
        {
                $user = Auth::user();

                if ($user->notes->count() >= Note::$maxNotes) {
                        return false;
                }

                $data['user_id'] = Auth::id();

                $note = Note::create($data);

                return $note;
        }

        public function update(array $data, Note $note): Note
        {
                $note->update($data);

                // $note->fill($data)->save();

                return $note;
        }

        public function delete(Note $note): bool
        {
                return $note->delete();
        }
}
