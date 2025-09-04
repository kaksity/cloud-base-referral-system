<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class CreateOtpTokenAction
{
    public function __construct(
        private OtpToken $otpToken
    )
    {}

    public function execute(array $createOtpTokenRecordOptions)
    {
        return $this->otpToken->create(
            $createOtpTokenRecordOptions
        );
    }
}