<?php
function imageResize($file3, $width, $height, $target)
{
    $targetWidth = $target;
    $targetHeight = $target;
    $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled($targetLayer, $file3, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
    return $targetLayer;
}

function insertImage($temp)
{
    // $file = $_FILES['file']['tmp_name'];
    $file = $temp;
    $sourceProperties = getimagesize($file);
    $imageType = $sourceProperties[2];
    $w = $sourceProperties[0];
    $h = $sourceProperties[1];

    if ($imageType == 2) {
        $file2 = imagecreatefromjpeg($file);
    } else if ($imageType == 3) {
        $file2 = imagecreatefrompng($file);
    }
    //CROPPING IMAGE INTO SQAURE
    if ($w > $h) {
        $x = ($w - $h) / 2;
        $y = 0;
        $file3 = imagecrop($file2, ['x' => $x, 'y' => $y, 'width' => $h, 'height' => $h]);
        $w = $h;
    } else if ($w < $h) {
        $y = ($h - $w) / 2;
        $x = 0;
        $file3 = imagecrop($file2, ['x' => $x, 'y' => $y, 'width' => $w, 'height' => $w]);
        $h = $w;
    } else if ($w == $h) {
        $file3 = $file2;
    }
    $newImageName = uniqid();
    $folderPath =  __DIR__ . "/../products/";
    $targetLayer = imageResize($file3, $w, $h, 250);
    imagejpeg($targetLayer, $folderPath . $newImageName . ".jpeg", 100);
    imagedestroy($targetLayer);

    return $newImageName;
}
