<?php

namespace App\Actions\User;

use App\Models\User;

class DeleteUserAction
{
    public function __construct(
        private User $user
    ) {}

    public function execute($userId)
    {
        $this->user->where('id', $userId)->delete();
    }
}
