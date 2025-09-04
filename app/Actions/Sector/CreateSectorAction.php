<?php

namespace App\Actions\Sector;

use App\Models\Sector;

class CreateSectorAction
{
    public function __construct(
        private Sector $sector
    ) {}

    public function execute(array $createSectorRecordOptions)
    {
        return $this->sector->create($createSectorRecordOptions);
    }
}
