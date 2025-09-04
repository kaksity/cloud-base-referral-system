<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class GetSystemAdminByEmailAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    ) {}
    public function execute(string $email, array $relationships = [])
    {
        return $this->systemAdmin->with(
            $relationships
        )->where([
            'email' => $email
        ])->first();
    }
}
