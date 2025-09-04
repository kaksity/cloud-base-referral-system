<?php

namespace App\Actions\Ward;

use App\Models\Ward;

class CreateWardAction
{
    public function __construct(
        private Ward $ward
    ) {}

    public function execute(array $createWardRecordOptions)
    {
        return $this->ward->create($createWardRecordOptions);
    }
}
