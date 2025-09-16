<?php

return [
    'current_media_upload_driver' => env('CURRENT_MEDIA_UPLOAD_DRIVER', 'cloudinary'),
    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
    ],
];
