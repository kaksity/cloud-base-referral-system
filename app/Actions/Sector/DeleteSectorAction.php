<?php

namespace App\Actions\Sector;

use App\Models\Sector;

class DeleteSectorAction
{
    public function __construct(
        private Sector $sector
    ) {}

    public function execute($sectorId)
    {
        $this->sector->where('id', $sectorId)->delete();
    }
}
