<?php

namespace App\InfrastructureProviders\Factory;

use App\InfrastructureProviders\External\CloudinaryMediaUploadDriver;

class MediaUploadFactory
{
    private $currentDriver;

    public function __construct()
    {
        $this->currentDriver = config('mediaUpload.current_media_upload_driver');

    }

    public function build()
    {
        if ($this->currentDriver === 'cloudinary') {
            return new CloudinaryMediaUploadDriver;
        }

        return 'error';
    }
}
