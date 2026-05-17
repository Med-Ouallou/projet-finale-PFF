<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected UserService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new UserService();
    }

    public function test_it_can_get_all_users()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test_user@example.com',
            'password' => Hash::make('password')
        ]);

        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->count());
        $this->assertInstanceOf(User::class, $result->first());
    }

    public function test_it_can_get_user_by_id()
    {
        $user = User::create([
            'name' => 'Find Me',
            'email' => 'findme@example.com',
            'password' => Hash::make('password')
        ]);

        $result = $this->service->getById($user->id);

        $this->assertEquals($user->id, $result->id);
    }

    public function test_it_can_create_a_user()
    {
        $data = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'secret123'
        ];

        $user = $this->service->create($data);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'newuser@example.com',
        ]);
        $this->assertTrue(Hash::check('secret123', $user->password));
    }

    public function test_it_can_update_a_user()
    {
        $user = User::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'password' => Hash::make('password')
        ]);

        $updatedData = [
            'name' => 'New Name',
            'password' => 'newpassword'
        ];

        $this->service->update($user->id, $updatedData);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
        ]);
        
        $user->refresh();
        $this->assertTrue(Hash::check('newpassword', $user->password));
    }

    public function test_it_can_delete_a_user()
    {
        $user = User::create([
            'name' => 'To Delete',
            'email' => 'delete@example.com',
            'password' => Hash::make('password')
        ]);

        $this->service->delete($user->id);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
