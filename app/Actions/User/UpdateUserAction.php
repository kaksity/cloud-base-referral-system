<?php

namespace App\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    public function __construct(
        private User $user
    ) {}

    public function execute($updateUserRecordOptions)
    {
        $id = $updateUserRecordOptions['id'];
        $data = $updateUserRecordOptions['data'];

        $this->user->where('id', $id)->update($data);
    }
}
