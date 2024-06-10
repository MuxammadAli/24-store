<?php


namespace App\Helpers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class File
{
    /**
     * @param UploadedFile $file
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    public static function upload(UploadedFile $file, string $path, int $width = null, int $height = null): string
    {
        if ($file->getMimeType() == 'image/svg' or $file->getMimeType() == 'image/gif' or $file->getMimeType() == 'image/svg+xml' or !$width)
            return $file->store('uploads/'.$path);

        $image = Image::make($file);

        if (getimagesize($file)[0] > $width) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if (!is_dir('uploads/'.$path)) {
            if (strpos($path, '/')) {
                $p = explode('/', $path);
                if (!is_dir('uploads/'.$p[0])) {
                    mkdir('uploads/'.$p[0], 0777, true);
                    mkdir('uploads/'.$p[0].'/'.$p[1], 0777, true);
                } else mkdir('uploads/'.$path, 0777, true);
            } else mkdir('uploads/'.$path, 0777, true);
        }

        $image->encode($file->extension(), 80);

        $path = 'uploads/'.$path.'/'.Str::random(40).'.'.$file->extension();

        $image->save(public_path($path));

        return $path;
    }

    /**
     * @param string|null $path
     */
    public static function delete(string $path = null)
    {
        if (is_file($path)) unlink($path);
    }
}
