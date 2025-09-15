<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Actions\Ward\ListWardsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\FetchWardsRequest;
use App\Http\Resources\Api\CaseWorker\Common\FetchWardsResource;

class FetchWardsController extends Controller
{
    public function __construct(

        private ListWardsAction $listWardsAction,
    ) {}

    public function __invoke(FetchWardsRequest $request)
    {

        $relationships = ['country', 'state', 'localGovernmentArea'];

        ['ward_payload' => $wards, 'pagination_payload' => $paginationPayload] = $this->listWardsAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'local_government_area_id' => $request->local_government_area_id
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);


        $mutatedWards = FetchWardsResource::collection($wards);

        $responsePayload = [
            'wards' => $mutatedWards,
            'pagination_payload' => $paginationPayload
        ];
        return generateSuccessApiMessage('Fetched wards successfully', 200, $responsePayload);
    }
}
