<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Actions\State\ListStatesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\FetchStatesRequest;
use App\Http\Resources\Api\CaseWorker\Common\FetchStatesResource;

class FetchStatesController extends Controller
{
    public function __construct(

        private ListStatesAction $listStatesAction
    ) {}

    public function __invoke(FetchStatesRequest $request)
    {
        $relationships = ['country'];

        ['state_payload' => $states, 'pagination_payload' => $paginationPayload] = $this->listStatesAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id,
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);

        $mutatedStates = FetchStatesResource::collection($states);

        $responsePayload = [
            'states' => $mutatedStates,
            'pagination_payload' => $paginationPayload
        ];
        return generateSuccessApiMessage('Fetched states successfully', 200, $responsePayload);
    }
}
