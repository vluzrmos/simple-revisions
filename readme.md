## Simple Revisions

That package listen for events in yours eloquent models and store the data that is saving/updating/creating.

# Installation

    composer require vluzroms/simple-revisions

put that service provider in your `config/app.php` file:

    Vluzrmos\SimpleRevisions\Providers\SimpleRevisionsServiceProvider::class
    
Run the artisan command to add the package migrations to your database migrations path: 

   php artisan vendor publish --provider=Vluzrmos\SimpleRevisions\Providers\SimpleRevisionsServiceProvider

And then run your migrations:

    php artisan migrate


> Note: Be sure that exists an users table.

