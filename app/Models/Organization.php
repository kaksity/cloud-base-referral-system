<?php

namespace App\Models;

class Organization extends AbstractModel
{
    public function addedBySystemAdmin()
    {
        return $this->belongsTo(SystemAdmin::class, 'added_by_system_admin_id');
    }
}
