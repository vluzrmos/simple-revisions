# Simple Revisions

[![Latest Stable Version](https://poser.pugx.org/vluzrmos/simple-revisions/v/stable)](https://packagist.org/packages/vluzrmos/simple-revisions) [![Total Downloads](https://poser.pugx.org/vluzrmos/simple-revisions/downloads)](https://packagist.org/packages/vluzrmos/simple-revisions) [![Latest Unstable Version](https://poser.pugx.org/vluzrmos/simple-revisions/v/unstable)](https://packagist.org/packages/vluzrmos/simple-revisions) [![License](https://poser.pugx.org/vluzrmos/simple-revisions/license)](https://packagist.org/packages/vluzrmos/simple-revisions)

That package listen for events in yours eloquent models and store the data that is saving/updating/creating.

## Installation

    composer require vluzrmos/simple-revisions

put that service provider in your `config/app.php` file:

    Vluzrmos\SimpleRevisions\Providers\SimpleRevisionsServiceProvider::class
    
Run the artisan command to add the package migrations to your database migrations path: 

    php artisan vendor:publish --provider=Vluzrmos\SimpleRevisions\Providers\SimpleRevisionsServiceProvider

And then run your migrations:

    php artisan migrate


> **Note:** Be sure that exists an users table (that table name is in your `config/auth.php`).

## Usage

The model you want to log revisions should be like that:

```php

use Illuminate\Database\Eloquent\Model;
use Vluzrmos\SimpleRevisions\Contracts\Revisionable;
use Vluzrmos\SimpleRevisions\Eloquent\RevisionableTrait;

class MyModel extends Model implements Revisionable
{
   use RevisionableTrait;
}

```

And then, when you save, update or delete an instance of your model, it should be revisioned!

