<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-6
 * Time: 下午6:41
 */

namespace app\base;


use Exception;
use Imagick;
use ImagickException;

class FileUtil
{
    /**
     *
     * Generate Thumbnail using Imagick class
     *
     * @param string $imgFile
     * @param int $width
     * @param int $height
     * @param int $quality
     * @return boolean on true
     * @throws Exception
     */
    public static function generateThumbnail($imgFile, $width, $height, $quality = 90)
    {
        if (is_file($imgFile)) {
            $imagick = new Imagick($imgFile);
            $imagick->setImageFormat('jpeg');
            $imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
            $imagick->setImageCompressionQuality($quality);
            $imagick->thumbnailImage($width, $height, true, false);

            $dir = pathinfo($imgFile, PATHINFO_DIRNAME);
            $base = pathinfo($imgFile, PATHINFO_FILENAME);
            $thumb_path = $dir.DIRECTORY_SEPARATOR.'.thumb'.DIRECTORY_SEPARATOR.$base.'.jpg';
            if (file_put_contents($thumb_path, $imagick) === false) {
                throw new Exception("Could not put contents.");
            }
            return $thumb_path;
        }
        else {
            throw new Exception("No valid image file provided with {$imgFile}.");
        }
    }

    public static function isImageMIME($mime)
    {
        return strpos("#".$mime, 'image/')!=FALSE;
    }

    public static function getIconByMIME($mime)
    {
        // for common MIME
        $map = [];
        $map['text/plain'] = 'txt';
        $map['application/pdf'] = 'pdf';
        $map['image/jpeg'] = 'jpeg';
        $map['image/png'] = 'png';
        $map['image/gif'] = 'gif';
        // TODO...
        if(isset($map[$mime])) {
            return $map[$mime];
        }

        // for special MIME
        $icon = 'blank';
        if(strpos($mime, 'officedocument.word')) {
            $icon = 'docx';
        }
        // TODO...
        return $icon;
    }

}