<?php

namespace App\Traits;

trait HasCreatorAndUpdater
{
    protected static function bootHasCreatorAndUpdater()
    {
        static::creating(function($model) {
            $model->creator_id = auth()->id();
            $model->updater_id = auth()->id();
        });

        static::updating(function($model) {
            $model->updater_id = auth()->id();
        });

    }

}

