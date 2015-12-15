<?php

namespace Vluzrmos\SimpleRevisions\Revisionable;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';

    protected $table = 'revisions';

    protected $fillable = ['user_id', 'data', 'event'];

    protected $casts = [
        'data' => 'array',
    ];

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