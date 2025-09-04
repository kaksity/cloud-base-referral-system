<?php

namespace App\Actions\OtpToken;

use App\Models\OtpToken;

class UpdateOtpTokenAction
{
    public function __construct(
        private OtpToken $otpToken
    )
    {
        
    }
    public function execute(array $updateOtpTokenRecordOptions)
    {
        $otpTokenId = $updateOtpTokenRecordOptions['id'];
        $data = $updateOtpTokenRecordOptions['data'];

        return $this->otpToken->where([
            'id' => $otpTokenId
        ])->update($data);
    }
}