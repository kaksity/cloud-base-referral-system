<?php

namespace App\Actions\SystemAdmin;

use App\Models\SystemAdmin;

class UpdateSystemAdminAction
{
    public function __construct(
        private SystemAdmin $systemAdmin
    )
    {
        
    }
    public function execute(array $updateSystemAdminRecordOptions)
    {
        $systemAdminId = $updateSystemAdminRecordOptions['id'];
        $data = $updateSystemAdminRecordOptions['data'];

        return $this->systemAdmin->where([
            'id' => $systemAdminId
        ])->update($data);
    }
}