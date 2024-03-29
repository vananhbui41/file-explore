<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles()
    {
        $folder = $this->getRoot();
        $files = File::query()
            ->where('parent_id', $folder->id)
            ->where('creator_id', auth()->id())
            ->orderBy('is_folder', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $files = FileResource::collection($files);

        return Inertia::render("MyFiles", compact('files'));
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();

        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->getRoot();
        }

        $file = new File();
        $file->is_folder = true;
        $file->name = $data['name'];

        $parent->appendNode($file);
    }

    private function getRoot()
    {
        return File::query()->whereIsRoot()->where('creator_id', auth()->id())->firstOrFail();
    }
}
