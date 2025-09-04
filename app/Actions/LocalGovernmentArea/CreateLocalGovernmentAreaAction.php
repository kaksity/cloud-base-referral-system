<?php

namespace App\Actions\LocalGovernmentArea;

use App\Models\LocalGovernmentArea;

class CreateLocalGovernmentAreaAction
{
    public function __construct(
        private LocalGovernmentArea $localGovernmentArea
    )
    {}

    public function execute(array $createLocalGovernmentAreaRecordOptions)
    {
        return $this->localGovernmentArea->create(
            $createLocalGovernmentAreaRecordOptions
        );
    }
}