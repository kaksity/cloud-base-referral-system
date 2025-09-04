<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class GetOtpTokenAction
{
    public function __construct(
        private OtpToken $otpToken
    ) {}
    public function execute(array $getTokenRecordOptions)
    {
        $emailAddress = $getTokenRecordOptions['email_address'];
        $purpose = $getTokenRecordOptions['purpose'];

        return $this->otpToken->where([
            'email_address' => $emailAddress,
            'purpose' => $purpose
        ])->first();
    }
}
