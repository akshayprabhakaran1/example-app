<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function (){
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('service.mailchimp.key'),
                'server' => ''
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */

    // this section runs when the app boots up
    public function boot(): void
    {
        // so unguarded is set here
        Model::unguard();
    }
}
