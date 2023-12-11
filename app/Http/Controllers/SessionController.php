<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("sessions.create");
    }

    /**
     * @throws ValidationException
     */
    public function store(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $attributes = request()->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                "email" => "Your provided credential could not be verified."
            ]);
        }

        // session fixation
        session()->regenerate();
        return redirect("/")->with("success", "Welcome Back!");

        // same as
        // return back()
        //     ->withInput()
        //     ->withErrors(["email"=> "Your provided credential could not be verified."]);
    }

    public function destroy(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        auth()->logout();

        return redirect("/")->with("success", "Goodbye!");
    }
}
