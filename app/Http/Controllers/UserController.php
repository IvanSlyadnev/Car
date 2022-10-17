<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request) {
        $this->authorize('viewAny', new User);
        return User::all();
    }

    public function create() {
        $this->authorize('create', new User);

        return [
            'user' => new User,
            'fields' => (new User())->getFillable()
        ];
    }

    public function store(UserRequest $request) {
        $this->authorize('create', new User);
        $user = User::create($request->only((new User())->getFillable()));
        return redirect()->route('user.edit', ['user' => $user->id])->with('status', 'Сотрудник создан');
    }

    public function edit(Request $request, User $user) {
        if (!$user->id) {
            $user = $request->user();
        } else {
            $this->authorize('update', $user);
        }

        return [
            'user' => $user
        ];
    }

    public function update(UserRequest $request, User $user) {
        if (!$user->id) {
            $user = $request->user();
        } else {
            $this->authorize('update', $user);
        }
        $user->update($request->only($user->getFillable()));
        return redirect()->route('user.edit', ['user' => $user->id])->with('status', 'Сотрудник обновлен');
    }

    public function destroy(Request $request, User $user) {
        if ($user != $request->user()) {
            $this->authorize('delete', $user);
            $user->delete();
            return redirect()->back()->with('status', 'Сотрудник удален');
        } else {
            return redirect()->back()->withErrors(__('errors.you_cannot_delete_yourself'));
        }
    }

    public function restore(User $user) {
        $this->authorize('restore', new User);
        if ($user = User::withTrashed()->find($user->id)) {
            if ($user->trashed()) {
                $user->restore();
                return redirect()->back()->with('status', 'Сотрудник восстановлен');
            }
        }

        return redirect()->back();
    }
}
