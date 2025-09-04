<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class GetOtpTokenByIdAction
{
    public function __construct(
        private OtpToken $otpToken
    )
    {
        
    }
    public function execute(string $otpTokenId, array $relationships = [])
    {
        return $this->otpToken->with(
            $relationships
        )->where([
            'id' => $otpTokenId
        ])->first();
    }
}