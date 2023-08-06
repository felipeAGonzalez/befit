<?php

namespace App;
use Illuminate\Support\Facades\Storage;

class Utils
{
    public static function saveImage($archivo)
    {
        if ($archivo) {
            $path = Storage::disk('public')->put('photo', $archivo);

            return Storage::url($path);
        }

        return null;
    }
    public static function deleteImage($archivo)
    {
        $archivo = str_replace('/storage/', '', $archivo);
        if (Storage::disk('public')->exists($archivo)) {
            Storage::disk('public')->delete($archivo);
        }
    }
}
