<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class CreateSystemAdminAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    )
    {}

    public function execute(array $createSystemAdminRecordOptions)
    {
        return $this->systemAdmin->create(
            $createSystemAdminRecordOptions
        );
    }
}