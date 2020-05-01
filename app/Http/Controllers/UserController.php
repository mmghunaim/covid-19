<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user, 'actions' => $user->actions]);
    }

    public function edit(User $user)
    {
        $this->authorize('manage', $user);

        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('manage', $user);

        $user->update($request->validated());

        return redirect('/users/'.$user->id);
    }
}
