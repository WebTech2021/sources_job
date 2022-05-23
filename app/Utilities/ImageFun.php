<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageFun
{
    public static function uploadSingleImage($file, string $folder = 'images/', bool $originalExtension = true)
    {
        $generateName = date('Ymdhms') . Str::random(6);
        if ($originalExtension) {
            $generateNameWithExt = '/' . $generateName . "." . $file->getClientOriginalExtension();
        } else {
            $generateNameWithExt = '/' . $generateName . "." . 'webp';
        }

        Storage::disk('public')->putFileAs($folder, $file, $generateNameWithExt);

        return $generateNameWithExt;
    }

}
