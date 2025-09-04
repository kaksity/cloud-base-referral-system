<?php

namespace App\Actions\Sector;

use App\Models\Sector;

class UpdateSectorAction
{
    public function __construct(
        private Sector $sector
    ) {}

    public function execute($updateSectorRecordOptions)
    {
        $id = $updateSectorRecordOptions['id'];
        $data = $updateSectorRecordOptions['data'];

        $this->sector->where('id', $id)->update($data);
    }
}
