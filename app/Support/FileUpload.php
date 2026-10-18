<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Small helper for uploading files and deleting old ones.
 * Files are stored in public/uploads/<folder>/.
 */
class FileUpload
{
    public static function store(UploadedFile $file, string $folder, string $prefix = 'file', ?string $old = null): string
    {
        $name = $prefix . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/' . $folder), $name);

        self::delete($folder, $old);

        return $name;
    }

    public static function delete(string $folder, ?string $name): void
    {
        if ($name) {
            $path = public_path('uploads/' . $folder . '/' . $name);
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
