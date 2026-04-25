<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index(Request $request)
    {
        $filters = [
            'is_admin' => $request->is_admin,
            'search' => $request->search,
        ];

        $query = $this->userService->getAll();

        if ($filters['is_admin'] !== null) {
            $query = $query->where('is_admin', $filters['is_admin']);
        }

        if ($filters['search']) {
            $query = $query->filter(function ($user) use ($filters) {
                return str_contains(strtolower($user->name), strtolower($filters['search']))
                    || str_contains(strtolower($user->email), strtolower($filters['search']));
            });
        }

        $users = $query;

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
        $this->userService->create($request->validated());

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

        $this->userService->update($id, $data);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(int $id)
    {
        if (auth()->id() === $id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $this->userService->delete($id);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
