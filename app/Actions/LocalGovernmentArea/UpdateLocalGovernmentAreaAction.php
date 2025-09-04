<?php

namespace App\Actions\LocalGovernmentArea;

use App\Models\LocalGovernmentArea;

class UpdateLocalGovernmentAreaAction
{
    public function __construct(
        private LocalGovernmentArea $localGovernmentArea
    )
    {
        
    }
    public function execute(array $updateLocalGovernmentAreaRecordOptions)
    {
        $localGovernmentAreaId = $updateLocalGovernmentAreaRecordOptions['id'];
        $data = $updateLocalGovernmentAreaRecordOptions['data'];

        return $this->localGovernmentArea->where([
            'id' => $localGovernmentAreaId
        ])->update($data);
    }
}