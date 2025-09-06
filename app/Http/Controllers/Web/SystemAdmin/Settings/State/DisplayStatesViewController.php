<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\State;

use App\Actions\Country\ListCountriesAction;
use App\Actions\State\ListStatesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\State\FetchStatesRequest;
use App\Http\Resources\Web\SystemAdmin\Common\FetchCountriesResource;
use App\Http\Resources\Web\SystemAdmin\Settings\State\FetchStatesResource;

class DisplayStatesViewController extends Controller
{
    public function __construct(
        private ListCountriesAction $listCountriesAction,
        private ListStatesAction $listStatesAction
    ) {}

    public function __invoke(FetchStatesRequest $request)
    {
        $relationships = ['country'];

        ['country_payload' => $countries] = $this->listCountriesAction->execute([]);

        ['state_payload' => $states, 'pagination_payload' => $paginationPayload] = $this->listStatesAction->execute([
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);

        $mutatedCountries = FetchCountriesResource::collection($countries)->resolve();
        $mutatedStates = FetchStatesResource::collection($states)->resolve();

        return inertia('system-admin/settings/state/index', [
            'states' => $mutatedStates,
            'countries' => $mutatedCountries,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
