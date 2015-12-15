<?php

namespace Vluzrmos\SimpleRevisions\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RevisionableTrait
 *
 * @package DoeApp\Revisionable
 *
 * @property Collection $revisions
 */
trait RevisionableTrait
{
    /**
     * @var bool
     */
    public $revisionsEnabled = true;

    public static $revisionsDisabledForAll;

    /**
     *
     */
    public static function bootRevisionableTrait()
    {
        static::observe(RevisionableObserver::class);
    }

    /**
     * @return mixed
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

    /**
     * @param Builder|\Illuminate\Database\Query\Builder $builder
     * @param null                                       $columns
     *
     * @return mixed
     */
    public function scopeWithRevisionsWithoutData($builder, $columns = null)
    {
        $columns = $columns ?: [
            'id',
            'event',
            'revisionable_type',
            'revisionable_id',
            'user_id',
            'created_at',
            'updated_at',
        ];

        $builder->with(
            [
                'revisions' => function ($q) use ($columns) {
                    /** @var Builder|\Illuminate\Database\Query\Builder $q */

                    $q->select($columns);
                    $q->with('user');
                },
            ]
        );

        return $builder;
    }

    /**
     * @return null
     */
    public function createdBy()
    {
        return $this->revisions->count() > 0 ? $this->revisions->first()->user : null;
    }

    /**
     * @return null
     */
    public function modifiedBy()
    {
        return $this->revisions->count() > 0 ? $this->revisions->last()->user : null;
    }

    /**
     * Indicate whenever the revisions are enabled.
     *
     * @return bool
     */
    public function revisionsEnabled()
    {
        return (static::$revisionsDisabledForAll !== true) && ($this->revisionsEnabled === true);
    }

    /**
     * Disable revisions for all of instances of this class.
     */
    public static function disableRevisionsForAll()
    {
        static::$revisionsDisabledForAll = true;
    }

    /**
     * Enable revisions for all of instances of this class.
     */
    public static function enableRevisionsForAll()
    {
        static::$revisionsDisabledForAll = false;
    }

    /**
     * @return $this
     */
    public function disableRevisions()
    {
        $this->revisionsEnabled = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function enableRevisions()
    {
        $this->revisionsEnabled = true;

        return $this;
    }
}