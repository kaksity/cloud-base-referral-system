<?php

namespace App\Http\Controllers\Api\CaseWorker\Service;

use App\Actions\Service\ListServicesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Service\FetchServicesRequest;
use App\Http\Resources\Api\CaseWorker\Service\FetchServicesResource;

class FetchServicesController extends Controller
{
    public function __construct(private ListServicesAction $listServicesAction) {}

    public function __invoke(FetchServicesRequest $request)
    {
        ['service_payload' => $services] = $this->listServicesAction->execute([
            'filter_record_options_payload' => [
                'organization_id' => $request->organization_id,
                'sector_id' => $request->sector_id,
            ]
        ]);

        $mutatedServices = FetchServicesResource::collection($services);

        return generateSuccessApiMessage('Fetched services successfully', $mutatedServices);
    }
}
