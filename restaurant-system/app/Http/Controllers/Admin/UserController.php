<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index(Request $request)
    {
        $filters = [
            'role' => $request->role,
            'search' => $request->search,
        ];

        $query = User::with('roles');

        if ($filters['role']) {
            $query = $query->role($filters['role']);
        }

        if ($filters['search']) {
            $query = $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%');
            });
        }

        $users = $query->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'users' => $users->values(),
                'filters' => $filters,
            ]);
        }

        return view('admin.users.index', compact('users', 'filters'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $role = $data['role'];
        unset($data['role']);
        unset($data['phone']);

        $user = $this->userService->create($data);
        $user->assignRole($role);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(int $id)
    {
        $user = $this->userService->getById($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $role = $data['role'] ?? null;
        unset($data['role']);

        $user = $this->userService->update($id, $data);

        if ($role) {
            $user->syncRoles([$role]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(Request $request, int $id)
    {
        if (auth()->id() === $id) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
            }
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $this->userService->delete($id);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Utilisateur supprimé avec succès.']);
        }

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
