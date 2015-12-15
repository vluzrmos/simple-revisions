<?php

namespace Vluzrmos\SimpleRevisions\Contracts;

interface Revisionable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisions();

    /**
     * Return array of data that was changed.
     *
     * @see \Illuminate\Database\Eloquent\Model::getDirty
     * @return array
     */
    public function getDirty();

    /**
     * @return mixed
     */
    public function getTouchedRelations();

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createdBy();

    /**
     * @return bool
     */
    public function revisionsEnabled();

    /**
     * @return static|\Illuminate\Database\Eloquent\Model
     */
    public function disableRevisions();

    /**
     * @return static|\Illuminate\Database\Eloquent\Model
     */
    public function enableRevisions();
}