<?php

namespace App\Actions\LocalGovernmentArea;

use App\Models\LocalGovernmentArea;

class GetLocalGovernmentAreaByIdAction
{
    public function __construct(
        private LocalGovernmentArea $localGovernmentArea
    )
    {
        
    }
    public function execute(string $localGovernmentAreaId, array $relationships = [])
    {
        return $this->localGovernmentArea->with(
            $relationships
        )->where([
            'id' => $localGovernmentAreaId
        ])->first();
    }
}