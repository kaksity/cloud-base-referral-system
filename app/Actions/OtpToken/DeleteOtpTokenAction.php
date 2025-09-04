<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class DeleteOtpTokenAction
{
    public function __construct(
        private OtpToken $otpToken
    )
    {
        
    }
    public function execute(string $otpTokenId)
    {
        return $this->otpToken->where([
            'id' => $otpTokenId
        ])->delete();
    }
}