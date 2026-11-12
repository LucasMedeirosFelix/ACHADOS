<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminAccountController extends Controller
{
    public function edit(Request $request): View
    {
        return view('found-items.admin.account', [
            'user' => $this->authenticatedUser($request),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $this->authenticatedUser($request);

        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:30',
                Rule::unique('users', 'username')->ignore($user->getKey()),
            ],
            'current_password' => ['required', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.current_password' => 'A senha atual não confere.',
        ]);

        $user->username = $validated['username'];

        if (filled($validated['new_password'] ?? null)) {
            $user->password = $validated['new_password'];
        }

        $user->save();

        return to_route('admin.account.edit')
            ->with('success', 'Os dados de acesso foram atualizados.');
    }

    private function authenticatedUser(Request $request): User
    {
        $user = $request->user();
        abort_unless($user instanceof User, 403);

        return $user;
    }
}
