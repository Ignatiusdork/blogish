<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    // put the newsletter service provider dependencies into this container so it can be resloved or taken out when needed
    public function register()
    {
        $this->app->bind(Newsletter::class, function () {

            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us11'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

     //restrict mass assignment ristrictions
    public function boot()
    {
        Model::unguard();
    }
}
