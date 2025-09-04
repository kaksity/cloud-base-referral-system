<?php

namespace App\Actions\LocalGovernmentArea;

use App\Models\LocalGovernmentArea;

class DeleteLocalGovernmentAreaAction
{
    public function __construct(
        private LocalGovernmentArea $localGovernmentArea
    )
    {
        
    }
    public function execute(string $localGovernmentAreaId)
    {
        return $this->localGovernmentArea->where([
            'id' => $localGovernmentAreaId
        ])->delete();
    }
}