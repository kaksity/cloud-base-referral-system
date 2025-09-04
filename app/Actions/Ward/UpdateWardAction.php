<?php

namespace App\Actions\Ward;

use App\Models\Ward;

class UpdateWardAction
{
    public function __construct(
        private Ward $ward
    ) {}

    public function execute($updateWardRecordOptions)
    {
        $id = $updateWardRecordOptions['id'];
        $data = $updateWardRecordOptions['data'];

        $this->ward->where('id', $id)->update($data);
    }
}
