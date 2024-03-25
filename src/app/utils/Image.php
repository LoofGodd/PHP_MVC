<?php
namespace App\Util;
use Ramsey\Uuid\UuidFactory;

class Image{

    public static function read(string $imageName): string|bool{
        $image = "app/assets/public/images/". $imageName;
        if(file_exists($image)){
            return $image;
        }
        return false;
    }
    public static function crop(string $filePath ,float $widthCrop=100){
        [$originalImage, $saveImageTo] = self::cropImageHelper($filePath);

        $originalName = basename($filePath);

        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);
        $heightCrop = intval(($widthCrop / $originalWidth) * $originalHeight);

        $croppedImage = imagecreatetruecolor($widthCrop, $heightCrop);
        imagecopyresampled($croppedImage, $originalImage, 0, 0, 0, 0, $widthCrop, $heightCrop, $originalWidth, $originalHeight);

        $is_saved = $saveImageTo($croppedImage, IMAGE_PATH . "/" . $originalName);
        imagedestroy($croppedImage);
        imagedestroy($originalImage);
    }
    public static function cropImageHelper($filePath){
        var_dump($filePath);
        if(!file_exists($filePath)){
            throw new \InvalidArgumentException('File "'.$filePath.'" not found.');
        }
        switch (strtolower(pathinfo($filePath, PATHINFO_EXTENSION))) {
            case 'jpg':
            case 'jpeg':
                return [imagecreatefromjpeg($filePath), function ($crop, $ori) {
                    return imagejpeg($crop, $ori);}];
            case 'png':
                return [imagecreatefrompng($filePath), function ($crop, $ori) {
                    return imagepng($crop, $ori);}];
            case 'gif':
                return [imagecreatefromgif($filePath), function ($crop, $ori) {
                    return imagegif($crop, $ori);}];
            case 'webp':
                return [imagecreatefromwebp($filePath), function ($crop, $ori) {
                    return imagewebp($crop, $ori);}];
            default:
            throw new \InvalidArgumentException('File "'.$filePath.'" is not valid jpg, png or gif image.');
        }
    }
    public static function delete(string $imageName):bool{
        $imagePath = IMAGE_PATH . '/' .$imageName;
        if(file_exists($imagePath)){
            if(unlink($imagePath)){
                return true;
            }
        }
        return false;
    }
    public static function update(string $oldImageName, array $file){
        self::delete($oldImageName);
        return self::create($file);
    }
    public static function create(array $file){
        if(!count($file) || empty($file['tmp_name'])){
            return false;
        }
        $uploadOk = 0;
            $isImage = getimagesize($file['tmp_name']);
            if ($isImage !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                $fileName = urldecode((new UuidFactory())->uuid4(). "_" . basename($file['name']));
                $targetPath = IMAGE_PATH . "/" . $fileName;
                if (move_uploaded_file($file['tmp_name'], $targetPath)){
                     self::crop($targetPath);
                } else{
                return false;}
            }else {
                return false;
            }
        return $fileName;
    }
}
