<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
        public function all(): array
        {
                return User::all()->toArray();
        }

        public function find(int $id): User
        {
                return User::find($id);
        }

        public function create(array $data): User
        {
                $data['password'] = Hash::make($data['password']);

                $user = User::create($data);

                $user->settings()->create(['user_id' => $user->id]);

                return $user;

                // return DB::transaction(function () use ($data) {
                //         $data = $data->except(['_token']);

                //         $data['password'] = Hash::make($data['password']);

                //         $user = User::create($data);

                //         $user->settings()->create(['user_id' => $user->id]);

                //         Auth::login($user);

                //         return $user;
                // });
        }

        public function update(array $data, User $user): User
        {
                if (isset($data['profile_photo'])) {
                        event(new \App\Events\DeleteFileEvent($user->avatar));

                        $file = $data['profile_photo'];

                        $path = "/uploads/profile/{$user->id}";

                        $path = $file->store($path, 'public');

                        // $user->avatar = $path;
                        $user->fill(['avatar' => $path]);
                }

                $user->fill($data)->save();

                // $user = User::find(Auth::id());

                // $data = $data->except(['_token', 'profile_photo', '_method']);

                // if ($data->hasFile('profile_photo')) {
                //     $file = $data->file('profile_photo');
                //     $fileName = $file->getClientOriginalName();

                //     $path = "/uploads/profile/{$user->id}";

                //     $file->storeAs($path, $fileName, 'public');

                //     $user->avatar = $path . '/' . $fileName;

                //     session('user')->avatar = $user->avatar;

                //     $data['avatar'] = asset('storage/' . $user->avatar);
                // }

                // $user->fill($data)->save();

                return $user;
        }

        public function delete(User $user): bool
        {
                return $user->delete();
        }
}
