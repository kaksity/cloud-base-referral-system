<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Actions\LocalGovernmentArea\ListLocalGovernmentAreasAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\FetchLocalGovernmentAreasRequest;
use App\Http\Resources\Api\CaseWorker\Common\FetchLocalGovernmentAreasResource;

class FetchLocalGovernmentAreasController extends Controller
{
    public function __construct(
        private ListLocalGovernmentAreasAction $listLocalGovernmentAreasAction
    ) {}

    public function __invoke(FetchLocalGovernmentAreasRequest $request)
    {
        $relationships = ['country', 'state'];

        ['local_government_area_payload' => $localGovernmentAreas, 'pagination_payload' => $paginationPayload] = $this->listLocalGovernmentAreasAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id,
                'state_id' => $request->state_id
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);


        $mutatedLocalGovernmentAreas = FetchLocalGovernmentAreasResource::collection($localGovernmentAreas);

        $responsePayload = [
            'local_government_areas' => $mutatedLocalGovernmentAreas,
            'pagination_payload' => $paginationPayload
        ];
        return generateSuccessApiMessage('Fetched local government areas successfully', 200, $responsePayload);
    }
}
