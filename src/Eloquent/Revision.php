<?php

namespace Vluzrmos\SimpleRevisions\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';

    protected $fillable = ['user_id', 'data', 'event'];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get table name.
     * @return mixed
     */
    public function getTable()
    {
        return config('revisions.table', 'revisions');
    }

    /**
     * Get the database connection for the model.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return static::resolveConnection(config('revisions.connection'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function revisionable()
    {
        return $this->morphTo('revisionable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.model'), 'user_id');
    }
}