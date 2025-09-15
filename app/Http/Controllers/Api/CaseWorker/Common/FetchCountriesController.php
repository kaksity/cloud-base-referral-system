<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Actions\Country\ListCountriesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\FetchCountriesRequest;
use App\Http\Resources\Api\CaseWorker\Common\FetchCountriesResource;

class FetchCountriesController extends Controller
{
    public function __construct(
        private ListCountriesAction $listCountriesAction
    ) {}

    public function __invoke(FetchCountriesRequest $request)
    {
        ['country_payload' => $countries, 'pagination_payload' => $paginationPayload] = $this->listCountriesAction->execute([
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ]);

        $mutatedCountries = FetchCountriesResource::collection($countries);

        $responsePayload = [
            'countries' => $mutatedCountries,
            'pagination_payload' => $paginationPayload
        ];

        return generateSuccessApiMessage('Fetched countries successfully', 200, $responsePayload);
    }
}
