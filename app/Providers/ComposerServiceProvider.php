<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        // view()->composer(
        //     'nav', 'App\Http\ViewComposers\NavComposer'
        // );

        // Using Closure based composers...
        view()->composer('layouts.partials._nav', function ($view) {
              $notifications = [];
              if(\Auth::check()){
                  $notifications = \Auth::user()->notifications();
              }
              $view->with('notifications', $notifications);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
