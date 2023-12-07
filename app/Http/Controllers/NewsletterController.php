<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use Illuminate\Validation\ValidationException;
use Mockery\Exception;

class NewsletterController extends Controller
{
    // mostly used for single function controllers
    /**
     * @throws ValidationException
     */
    public function __invoke(MailchimpNewsletter $newsletter)
    {
        request()->validate([
            'email' => 'required|email'
        ]);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This are new signed up for our newsletter.'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter.');
    }
}
