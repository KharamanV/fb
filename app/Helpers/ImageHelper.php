<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageHelper 
{

    protected static $smallFolder = '60';

    protected static $mediumFolder = '800';

    protected static $originalFolder = 'original';

    protected static $avatarFolder = '150';

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

    public static function uploadAvatar($img) 
    {
        $name = md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
        $path = public_path('uploads/avatars/');

        Image::make($img)
                ->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . self::$avatarFolder . '/' . $name)
                ->resize(60, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . self::$smallFolder . '/' . $name);
        
        return $name;
    }

    public static function deleteAvatar($imgName)
    {
        $subFolder = 'avatars/';

        Storage::delete([
            $subFolder . self::$avatarFolder . '/' . $imgName,
            $subFolder . self::$smallFolder . '/' . $imgName,
        ]);
    }






}