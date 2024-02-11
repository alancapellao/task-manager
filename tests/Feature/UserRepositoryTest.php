<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Requests\UserFormRequest;
use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
        use RefreshDatabase;

        /**
         * A basic test example.
         */
        public function test_the_request_from_the_user_repository_returns_a_successful_response(): void
        {
                // Arrange
                /** @var UserRepository $repository */
                $repository = $this->app->make(UserRepository::class);
                $request = new UserFormRequest();
                $request->merge([
                        'name' => 'Nome do usuário',
                        'username' => 'username',
                        'email' => 'example.test@example.com',
                        'password' => 'password',
                        'password_confirmation' => 'password',
                ]);

                // Act
                $repository->create($request);

                // Assert
                $this->assertDatabaseHas('users', ['name' => 'Nome do usuário']);
                $this->assertDatabaseHas('users', ['username' => 'username']);
        }
}
