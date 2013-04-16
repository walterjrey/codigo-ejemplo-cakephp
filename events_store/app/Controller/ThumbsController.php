<?php
class ThumbsController extends AppController {
    var $allowableTypes = array(
        IMAGETYPE_GIF,
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG
    );

    function imageCreateFromFile($filename, $imageType) {

        switch($imageType) {
            case IMAGETYPE_GIF  : return imagecreatefromgif($filename);
            case IMAGETYPE_JPEG : return imagecreatefromjpeg($filename);
            case IMAGETYPE_PNG  : return imagecreatefrompng($filename);
            default             : return false;
        }

    }

    function show($id, $maxWidth, $maxHeight, $format,$targetFormatOrFilename = 'jpg', $image_section = 'original') {
        $sourceFilename = WWW_ROOT.'uploaded_images/'.$id.'/'.$image_section.'.'.$format;
        $size = getimagesize($sourceFilename);


        if(!in_array($size[2], $this->allowableTypes)) {
            return false;
        }

        $pathinfo = pathinfo($targetFormatOrFilename);
        if($pathinfo['basename'] == $pathinfo['filename']) {
            $extension = strtolower($targetFormatOrFilename);

            $targetFormatOrFilename = null;
        }
        else {
            $extension = strtolower($pathinfo['extension']);
        }

        switch($extension) {
            case 'gif' : $function = 'imagegif'; break;
            case 'png' : $function = 'imagepng'; break;
            default    : $function = 'imagejpeg'; break;
        }

        // load the image and return false if didn't work
        $source = $this->imageCreateFromFile($sourceFilename, $size[2]);
        if(!$source) {
            return false;
        }

        // write out the appropriate HTTP headers if going to browser
        if($targetFormatOrFilename == null) {
            if($extension == 'jpg') {
                header("Content-Type: image/jpeg");
            }
            else {
                header("Content-Type: image/$extension");
            }
        }

        // if the source fits within the maximum then no need to resize
        if($size[0] <= $maxWidth && $size[1] <= $maxHeight) {
            $function($source, $targetFormatOrFilename);
        }
        else {

            $ratioWidth = $maxWidth / $size[0];
            $ratioHeight = $maxHeight / $size[1];

            // use smallest ratio
            if($ratioWidth < $ratioHeight) {
                $newWidth = $maxWidth;
                $newHeight = round($size[1] * $ratioWidth);
            }
            else {
                $newWidth = round($size[0] * $ratioHeight);
                $newHeight = $maxHeight;
            }

            $target = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($target, $source, 0, 0, 0, 0, $newWidth, $newHeight, $size[0], $size[1]);
            $function($target, $targetFormatOrFilename);

        }

        die;

    }
}