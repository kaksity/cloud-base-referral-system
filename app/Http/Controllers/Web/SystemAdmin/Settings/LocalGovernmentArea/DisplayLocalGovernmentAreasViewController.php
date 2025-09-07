<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea;

use App\Actions\Country\ListCountriesAction;
use App\Actions\LocalGovernmentArea\ListLocalGovernmentAreasAction;
use App\Actions\State\ListStatesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\LocalGovernmentArea\FetchLocalGovernmentAreasRequest;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchCountriesResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchStatesResource;
use App\Http\Resources\Web\SystemAdmin\Settings\LocalGovernmentArea\FetchLocalGovernmentAreasResource;

class DisplayLocalGovernmentAreasViewController extends Controller
{
    public function __construct(
        private ListCountriesAction $listCountriesAction,
        private ListStatesAction $listStatesAction,
        private ListLocalGovernmentAreasAction $listLocalGovernmentAreasAction
    ) {}

    public function __invoke(FetchLocalGovernmentAreasRequest $request)
    {

        ['country_payload' => $countries] = $this->listCountriesAction->execute([]);

        ['state_payload' => $states] = $this->listStatesAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id ?? null
            ]
        ]);

        $relationships = ['country', 'state'];

        ['local_government_area_payload' => $localGovernmentAreas, 'pagination_payload' => $paginationPayload] = $this->listLocalGovernmentAreasAction->execute([
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);

        $mutatedCountries = FetchCountriesResource::collection($countries)->resolve();
        $mutatedStates = FetchStatesResource::collection($states)->resolve();
        $mutatedLocalGovernmentAreas = FetchLocalGovernmentAreasResource::collection($localGovernmentAreas)->resolve();

        return inertia('system-admin/settings/local-government-area/index', [
            'localGovernmentAreas' => $mutatedLocalGovernmentAreas,
            'countries' => $mutatedCountries,
            'states' => $mutatedStates,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
