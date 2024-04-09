<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "path" => $this->path,
            "parent_id" => $this->parent_id,
            "is_folder" => $this->is_folder,
            "mime" => $this->mime,
            "size" => $this->get_file_size(),
            "owner" => $this->owner,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
            "creator_id" => $this->creator_id,
            "updater_id" => $this->updater_id,
            "delete_at" => $this->delete_at,
        ];
    }
}
