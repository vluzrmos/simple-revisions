<?php

namespace Vluzrmos\SimpleRevisions\Providers;

use Illuminate\Support\ServiceProvider;

class SimpleRevisionsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $basePath = __DIR__.'/../..';

        $this->publishes([
            $basePath.'/migrations' => database_path('migrations'),
            $basePath.'/config/revisions.php' => config_path('revisions.php')
        ]);
    }
}
