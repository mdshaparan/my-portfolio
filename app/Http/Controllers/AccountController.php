<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function edit()
    {
        return view('backend.account.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'email'            => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password'         => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.account.edit')->with('success', 'Account updated successfully.');
    }
}