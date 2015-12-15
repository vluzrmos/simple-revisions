<?php

namespace Vluzrmos\SimpleRevisions\Revisionable;

use Vluzrmos\SimpleRevisions\Contracts\Revisionable;

class RevisionableObserver
{
    /**
     * @var Revision
     */
    private $revision;

    /**
     * @param Revision $revision
     */
    public function __construct(Revision $revision)
    {
        $this->revision = $revision;
    }

    /**
     * @param $model
     */
    public function created(Revisionable $model)
    {
        $this->createRevision($model, Revision::CREATED);
    }

    /**
     * @param Revisionable $model
     * @param              $event
     */
    protected function createRevision(Revisionable $model, $event)
    {
        if ($model->revisionsEnabled()) {
            $data = $this->changes($model);
            $user_id = $this->user();

            $model->revisions()->create(compact('user_id', 'data', 'event'));

            $touches = $model->getTouchedRelations();

            if (!empty($touches)) {
                $this->createTouchRevision($model, $touches);
            }
        }
    }

    /**
     * @param Revisionable $model
     *
     * @return array|null
     */
    protected function changes(Revisionable $model)
    {
        $data = array_except($model->getDirty(), ['created_at', 'updated_at', 'deleted_at']);

        $data = count($data) ? $data : null;

        return $data;
    }

    /**
     * @return int
     */
    protected function user()
    {
        $user_id = auth()->check() ? auth()->user()->id : null;

        return $user_id;
    }

    /**
     * Fixes uncatched touch events.
     *
     * @param Revisionable $revisionable
     * @param array        $touches
     */
    protected function createTouchRevision(Revisionable $revisionable, array $touches = [])
    {
        foreach ($touches as $relation) {
            $models = $revisionable->$relation()->get();

            foreach ($models as $model) {
                $this->updated($model);
            }
        }
    }

    /**
     * @param Revisionable $model
     */
    public function updated(Revisionable $model)
    {
        $this->createRevision($model, Revision::UPDATED);
    }

    /**
     * @param Revisionable $model
     */
    public function deleted(Revisionable $model)
    {
        $this->createRevision($model, Revision::DELETED);
    }
}
