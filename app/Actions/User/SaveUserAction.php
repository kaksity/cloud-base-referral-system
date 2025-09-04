<?php

namespace App\Actions\User;

use App\Models\User;

class SaveUserAction
{
    public function __construct(
        private User $user
    ) {}

    public function execute(array $saveUserOptions)
    {
        return $this->user->updateOrCreate(
            ['id' => $saveUserOptions['id']],
            [
                'full_name' => $saveUserOptions['full_name'],
                'email_address' => $saveUserOptions['email_address'],
                'email_verified_at' => $saveUserOptions['email_verified_at'],
                'company_id' => $saveUserOptions['company_id'],
                'role_type' => $saveUserOptions['role_type'],
                'access_token' => $saveUserOptions['access_token'],
                'refresh_token' => $saveUserOptions['refresh_token'],
                'token_expires_at' => now()->addSeconds($saveUserOptions['expires_in']),
            ]
        );
    }
}
