<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Ward;

use App\Actions\Country\ListCountriesAction;
use App\Actions\LocalGovernmentArea\ListLocalGovernmentAreasAction;
use App\Actions\Ward\ListWardsAction;
use App\Actions\State\ListStatesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Ward\FetchWardsRequest;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchCountriesResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchLocalGovernmentAreasResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchStatesResource;
use App\Http\Resources\Web\SystemAdmin\Settings\Ward\FetchWardsResource;

class DisplayWardsViewController extends Controller
{
    public function __construct(
        private ListCountriesAction $listCountriesAction,
        private ListStatesAction $listStatesAction,
        private ListLocalGovernmentAreasAction $listLocalGovernmentAreasAction,
        private ListWardsAction $listWardsAction,
    ) {}

    public function __invoke(FetchWardsRequest $request)
    {

        ['country_payload' => $countries] = $this->listCountriesAction->execute([]);

        ['state_payload' => $states] = $this->listStatesAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id ?? null
            ]
        ]);

        ['local_government_area_payload' => $localGovernmentAreas] = $this->listLocalGovernmentAreasAction->execute([
            'filter_record_options_payload' => [
                'country_id' => $request->country_id ?? null,
                'state_id' => $request->state_id ?? null
            ]
        ]);

        $relationships = ['country', 'state', 'localGovernmentArea'];

        ['ward_payload' => $wards, 'pagination_payload' => $paginationPayload] = $this->listWardsAction->execute([
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ], $relationships);

        $mutatedCountries = FetchCountriesResource::collection($countries)->resolve();
        $mutatedStates = FetchStatesResource::collection($states)->resolve();
        $mutatedLocalGovernmentAreas = FetchLocalGovernmentAreasResource::collection($localGovernmentAreas)->resolve();
        $mutatedWards = FetchWardsResource::collection($wards)->resolve();

        return inertia('system-admin/settings/ward/index', [
            'wards' => $mutatedWards,
            'countries' => $mutatedCountries,
            'states' => $mutatedStates,
            'localGovernmentAreas' => $mutatedLocalGovernmentAreas,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
