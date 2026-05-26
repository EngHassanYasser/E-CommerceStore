<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

abstract class  FileService extends BaseService
{
    public static function upload($file, $folder = 'images_folder')
    {
        if (! $file) {
            return null;
        }

        return $file->store($folder, 'public');
    }
    public static function update($file, $oldPath, $folder = 'images_folder')
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

    public static function delete($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
    public static function DeleteFromFolder($folder_name,$image_name)
    {
        Storage::disk('public')->delete($folder_name.'/' . $image_name);
    }
}
