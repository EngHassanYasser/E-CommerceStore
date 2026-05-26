<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

abstract class  FileService extends BaseService
{
    public static function upload($file, $folder = 'images_folder')
    {
        if (! $file || ! $file->isValid()) {
            return null;
        }

        $name = uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move(storage_path('app/public/' . $folder), $name);

        return $name;
    }

    public static function replaceImage(
        $file,
        ?string $oldPath = null,
        string $folderName = 'public_files',
        string $disk = 'public'
    ): ?string {

        if (! $file || ! $file->isValid()) {
            return $oldPath;
        }

        try {
            $fileName = FileService::upload($file, $folderName);

            if ($oldPath) {
                FileService::DeleteFromFolder($fileName, $folderName, $disk);
            }

            return $fileName;
        } catch (\Throwable $e) {
            report($e);
            return $oldPath;
        }
    }
    public static function DeleteFromFolder($fileName, $folderName, $disk='public')
    {
        $path = $fileName . '/' . $folderName;
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($folderName . '/' . $fileName);
        }
    }
}
