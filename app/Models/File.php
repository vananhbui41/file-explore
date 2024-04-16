<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
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

    public function owner(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $attributes['creator_id'] == auth()->id() ? 'me' :
                    $this->user->name;
            }
        );
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
        return $this->parent_id == null;
    }

    /**
     * Get the size of the file in a human readable format.
     *
     * @return string
     */
    public function get_file_size()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $power = $this->size > 0 ? floor(log($this->size, 1024)) : 0;

        return number_format($this->size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->parent) {
                return;
            }

            $model->path = (!$model->parent->isRoot() ? $model->parent->path . '/' : '') . str()->slug($model->name);
        });

        static::deleted(function (File $model) {
            if (!$model->is_folder) {
                Storage::delete($model->storage_path);
            }
        });
    }
}
