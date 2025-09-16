<?php

namespace App\InfrastructureProviders\External;

use App\InfrastructureProviders\TypeChecking\MediaUploadInterface;
use Cloudinary\Cloudinary;

class CloudinaryMediaUploadDriver implements MediaUploadInterface
{
    private $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }

    public function upload(array $uploadFileOptions)
    {
        $file = $uploadFileOptions['file'];

        $uploadResults = $this->cloudinary->uploadApi()->upload($file->getRealPath());

        return $uploadResults['secure_url'];
    }
}
