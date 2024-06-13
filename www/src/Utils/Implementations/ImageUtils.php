<?php

namespace App\Utils\Implementations;

use App\Utils\IImageUtils;
use finfo;

class ImageUtils implements IImageUtils
{
    public function removeImageDataPrefix(string $base64Image): string
    {
        return preg_replace('#^data:image/[^;]+;base64,#', "", $base64Image);
    }

    public function validate(string $base64Image): bool
    {
        $base64ImageParsed = base64_decode($base64Image);

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $imageTypes = ["image/png", "image/jpeg", "image/jpg"];

        $imageType = $finfo->buffer($base64ImageParsed);

        return in_array($imageType, $imageTypes);
    }

    public function convertBase64ToBinary(string $base64Image): mixed
    {
        $base64ImageParsed = base64_decode($base64Image, true);

        return $base64ImageParsed;
    }
}
