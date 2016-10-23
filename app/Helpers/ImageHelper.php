<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageHelper 
{
    /** @var string Name of the folder, which contains small resized images */
    protected static $smallFolder = '60';

    /** @var string Name of the folder, which contains medium resized images */
    protected static $mediumFolder = '800';

    /** @var string Name of the folder, which contains original copy of images */
    protected static $originalFolder = 'original';

    /** @var string Name of the folder, which contains avatar resized images */
    protected static $avatarFolder = '150';

    /**
     * Uploads image to storage with different sizes
     *
     * @param resource $img POST image
     * @return string Final name of the uploaded image
     */
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

    /**
     * Deletes image from storage and all sizes
     *
     * @param string $imgName Name of the image which need to delete
     * @return void
     */
    public static function delete($imgName)
    {
        Storage::delete([
            self::$smallFolder . '/' . $imgName,
            self::$mediumFolder . '/' . $imgName,
            self::$originalFolder . '/' . $imgName,
        ]);
    }

    /**
     * Uploads avatar image to storage with different sizes
     *
     * @param resource $img POST image (avatar)
     * @return string Final name of the uploaded avatar
     */
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

    /**
     * Deletes avatar from storage and all sizes
     *
     * @param string $imgName Name of the avatar image
     * @return void
     */
    public static function deleteAvatar($imgName)
    {
        $subFolder = 'avatars/';

        Storage::delete([
            $subFolder . self::$avatarFolder . '/' . $imgName,
            $subFolder . self::$smallFolder . '/' . $imgName,
        ]);
    }

}