<?php

namespace App\Actions\Service;

use App\Models\Service;

class GetServiceByIdAction
{
    public function __construct(
        private Service $service
    ) {}

    public function execute(string $serviceId)
    {
        return $this->service->where('id', $serviceId)->first();
    }
}
