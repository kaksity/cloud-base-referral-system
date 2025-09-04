<?php

namespace App\Actions\Service;

use App\Models\Service;

class CreateServiceAction
{
    public function __construct(
        private Service $service
    ) {}

    public function execute(array $createServiceRecordOptions)
    {
        return $this->service->create($createServiceRecordOptions);
    }
}
