<?php

namespace Vluzrmos\SimpleRevisions;

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
        $this->publishes([
            __DIR__.'/../../migrations' => database_path('migrations')
        ]);
    }
}
