<?php

namespace App\InfrastructureProviders\TypeChecking;

interface MediaUploadInterface
{
    public function upload(array $uploadFileOptions);
}
