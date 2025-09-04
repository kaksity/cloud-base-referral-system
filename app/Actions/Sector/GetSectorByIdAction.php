<?php

namespace App\Actions\Sector;

use App\Models\Sector;

class GetSectorByIdAction
{
    public function __construct(
        private Sector $sector
    ) {}

    public function execute(string $sectorId)
    {
        return $this->sector->where('id', $sectorId)->first();
    }
}
