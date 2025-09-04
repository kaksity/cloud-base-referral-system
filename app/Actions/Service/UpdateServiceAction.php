<?php

namespace App\Actions\Service;

use App\Models\Service;

class UpdateServiceAction
{
    public function __construct(
        private Service $service
    ) {}

    public function execute($updateServiceRecordOptions)
    {
        $id = $updateServiceRecordOptions['id'];
        $data = $updateServiceRecordOptions['data'];

        $this->service->where('id', $id)->update($data);
    }
}
