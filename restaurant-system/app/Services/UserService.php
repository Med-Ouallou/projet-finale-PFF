<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll(array $filters = [])
    {
        $query = User::with('roles');

        if (!empty($filters['role'])) {
            $query->role($filters['role']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->get();
    }

    public function getById(int $id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data, ?string $role = null)
    {
        $user = User::create($data);
        if ($role) {
            $user->assignRole($role);
        }
        return $user;
    }

    public function update(int $id, array $data, ?string $role = null)
    {
        $user = $this->getById($id);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        if ($role) {
            $user->syncRoles([$role]);
        }

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
