<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasFactory, HasCreatorAndUpdater, NodeTrait, SoftDeletes;

    /**
     * Get the owning user of the file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent of the file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(File::class, 'parent_id');
    }

    /**
     * Determine if the given user ID owns the file.
     *
     * @param int $userId
     * @return bool
     */
    public function isOwnedBy($userId): bool
    {
        return $this->creator_id == $userId;
    }

    public function isRoot()
    {
        return $this->parent_id === null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            if (!$model->parent) {
                return;
            }

            $model->path = (!$model->parent->isRoot() ? $model->parent->path . '/' : '') . str()->slug($model->name);
        });
    }
}
