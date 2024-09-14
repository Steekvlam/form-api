<?php

namespace FormBuilder\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use FormBuilder\User\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user())->first();

        return Inertia::render('User/Account', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user())->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($request->all());

        return Redirect::back()->with('success', 'Account updated.');
    }
}
