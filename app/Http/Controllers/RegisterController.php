<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('pages.auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Normalize phone: strip surrounding and internal whitespace before validation
        if ($request->filled('phone')) {
            $request->merge(['phone' => preg_replace('/\s+/', '', trim($request->phone))]);
        }
        // dd($request->reg);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'faculty' => ['nullable', 'string', 'max:255'],
            'reg' => ['required', 'string', 'max:30'],
            'department' => ['nullable', 'string', 'max:255'],
            'salute' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => [
                'nullable',
                'string',
                // Tanzania (+255/0 + 6x/7x + 8 digits) or generic international (+country + 6-14 digits)
                'regex:/^(\+?255|0)[67]\d{8}$/',
                'unique:users,phone',
            ],
            'role' => ['required', 'in:student,staff'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'faculty' => $request->faculty,
            'reg' => $request->reg,
            'department' => $request->department,
            'salute' => $request->salute,
            'title' => $request->title,
            'phone' => $request->phone, // already normalized via merge above
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'email_verified_at' => null,
            'status' => 'pending',
        ]);
        // dd($user);
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email to verify your account.');
    }
}
