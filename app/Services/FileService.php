<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService extends BaseService
{
    public function upload($file, $folder = 'images_folder')
    {
        if (! $file) {
            return null;
        }

        return $file->store($folder, 'public');
    }
    public function update($file, $oldPath, $folder = 'images_folder')
    {
        if (! $file) {
            return $oldPath;
        }

        // upload new image
        $newPath = $file->store($folder, 'public');

        // delete old image
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        return $newPath;
    }

    public function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
