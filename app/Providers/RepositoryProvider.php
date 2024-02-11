<?php

namespace App\Providers;

use App\Repositories\EloquentListaRepository;
use App\Repositories\ListaRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentNoteRepository;
use App\Repositories\NoteRepository;
use App\Repositories\EloquentSettingsRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\EloquentTagRepository;
use App\Repositories\TagRepository;
use App\Repositories\EloquentTaskRepository;
use App\Repositories\TaskRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\UserRepository;

class RepositoryProvider extends ServiceProvider
{
        public array $bindings = [
                ListaRepository::class => EloquentListaRepository::class,
                NoteRepository::class => EloquentNoteRepository::class,
                SettingsRepository::class => EloquentSettingsRepository::class,
                TagRepository::class => EloquentTagRepository::class,
                TaskRepository::class => EloquentTaskRepository::class,
                UserRepository::class => EloquentUserRepository::class,
        ];

        /**
         * Register services.
         */
        public function register(): void
        {
                // 
        }

        /**
         * Bootstrap services.
         */
        public function boot(): void
        {
                //
        }
}
