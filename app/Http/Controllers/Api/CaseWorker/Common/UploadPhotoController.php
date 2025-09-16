<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\UploadPhotoRequest;
use App\InfrastructureProviders\Factory\MediaUploadFactory;

class UploadPhotoController extends Controller
{
    public function __construct(
        private MediaUploadFactory $mediaUploadFactory
    ) {}

    public function __invoke(UploadPhotoRequest $request)
    {


        $mediaUploadDriver = $this->mediaUploadFactory->build();

        if ($mediaUploadDriver === 'error') {
            return generateErrorApiMessage('Media upload service is unavailable', 503);
        }

        $uploadResultUrl = $mediaUploadDriver->upload($request->photo);

        $responsePayload = [
            'photo_url' => $uploadResultUrl
        ];

        return generateSuccessApiMessage('Photo upload successfully', 200, $responsePayload);
    }
}
