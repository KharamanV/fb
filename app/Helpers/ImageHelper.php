<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageHelper 
{

    protected static $smallFolder = '60';

    protected static $mediumFolder = '800';

    protected static $originalFolder = 'original';

    public static function upload($img) 
    {
        $name = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        $path = public_path('uploads/');

        Image::make($img)
                ->save($path . self::$originalFolder . '/' . $name)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . self::$mediumFolder . '/' . $name)
                ->resize(60, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . self::$smallFolder . '/' . $name);

        return $name;
    }

    public static function delete($imgName)
    {
        Storage::delete([
            self::$smallFolder . '/' . $imgName,
            self::$mediumFolder . '/' . $imgName,
            self::$originalFolder . '/' . $imgName,
        ]);
    }


}