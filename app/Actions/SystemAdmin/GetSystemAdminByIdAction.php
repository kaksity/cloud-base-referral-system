<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class GetSystemAdminByIdAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    )
    {
        
    }
    public function execute(string $systemAdminId, array $relationships = [])
    {
        return $this->systemAdmin->with(
            $relationships
        )->where([
            'id' => $systemAdminId
        ])->first();
    }
}