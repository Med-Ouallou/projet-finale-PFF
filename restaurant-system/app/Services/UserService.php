<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::all();
    }

    public function getById(int $id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->getById($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->getById($id);
        return $user->delete();
    }

    public function assignRole(int $userId, string $roleName)
    {
        $user = $this->getById($userId);
        // Assuming Spatie Roles or similar if class diagram mentioned it
        if (method_exists($user, 'assignRole')) {
            return $user->assignRole($roleName);
        }
        return false;
    }
}
