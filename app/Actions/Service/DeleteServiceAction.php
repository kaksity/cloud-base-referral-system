<?php

namespace App\Actions\Service;

use App\Models\Service;

class DeleteServiceAction
{
    public function __construct(
        private Service $service
    ) {}

    public function execute($serviceId)
    {
        $this->service->where('id', $serviceId)->delete();
    }
}
