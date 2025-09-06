<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Country;

use App\Actions\Country\ListCountriesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Country\FetchCountriesRequest;
use App\Http\Resources\Web\SystemAdmin\Settings\Country\FetchCountriesResource;

class DisplayCountriesViewController extends Controller
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

        $mutatedCountries = FetchCountriesResource::collection($countries)->resolve();

        return inertia('system-admin/settings/country/index', [
            'countries' => $mutatedCountries,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
