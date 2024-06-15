<?php

namespace App\Utils;

interface IImageUtils
{
    /**
     * Remove the prefix from the base64 image data
     *
     * @param string $base64Iamge
     * @return string
     */
    public function removeImageDataPrefix(string $base64Iamge): string;
    /**
     * Validate the base64 image data
     *
     * @param string $base64Iamge
     * @return bool
     */
    public function validate(string $base64Iamge): bool;
    /**
     * Convert the base64 image data to binary
     *
     * @param string $base64Image
     * @return mixed
     */
    public function convertBase64ToBinary(string $base64Image): mixed;
    /**
     * Convert the binary image data to base64
     *
     * @param mixed $binaryImage
     * @return string
     */
    public function convertBinaryToBase64(mixed $binaryImage): string;
}
