<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class DeleteSystemAdminAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    )
    {
        
    }
    public function execute(string $systemAdminId)
    {
        return $this->systemAdmin->where([
            'id' => $systemAdminId
        ])->delete();
    }
}