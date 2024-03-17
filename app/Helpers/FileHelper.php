<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileHelper
{
    public static function uploadFile(UploadedFile $file, $directory, $fileName = null)
    {
        $fileName = $fileName ?: uniqid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs($directory, $fileName, 'public');

        if ($path) {
            return $fileName;
        }

        return false;
    }

    public static function deleteFile($dir, $name)
    {
        $path = $dir . '/' . $name;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
