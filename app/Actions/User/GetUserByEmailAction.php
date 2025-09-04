<?php

namespace App\Actions\User;

use App\Models\User;

class GetUserByEmailAction
{
    public function __construct(
        private User $user
    ) {}

    public function execute(string $emailAddress)
    {
        return $this->user->where('email_address', $emailAddress)->first();
    }
}
