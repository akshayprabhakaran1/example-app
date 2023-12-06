<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view("register.create");
    }

    public function store(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        // max length
        // min length
        // create the user
        // if validation fails laravel will redirect back to the previous page
        // unique:users,username telling in users table the column username should be unique
        // 'username' => 'required|min:3|max:255|unique:users,username'
        // Rule::unique are usefully in update because we can chain the events

        $attributes = request()->validate([
            'name' => 'required|max:255|',
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')], // we need to accept a valid email not some jabarish so we use email
            'password' => ['required', 'min:7', 'max:255'],
        ]);

        $user = User::create($attributes);

        // can also use Auth Facade
        auth()->login($user);

        // same as flashing the data through the session with
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
