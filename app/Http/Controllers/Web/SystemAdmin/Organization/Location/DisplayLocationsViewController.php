<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization\Location;

use App\Actions\Country\ListCountriesAction;
use App\Actions\LocalGovernmentArea\ListLocalGovernmentAreasAction;
use App\Actions\Organization\GetOrganizationByIdAction;
use App\Actions\Location\ListLocationsAction;
use App\Actions\State\ListStatesAction;
use App\Actions\Ward\ListWardsAction;
use App\Http\Requests\Web\SystemAdmin\Organization\Location\FetchLocationsRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Ward\FetchWardsRequest;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchCountriesResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchLocalGovernmentAreasResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchStatesResource;
use App\Http\Resources\Web\SystemAdmin\Common\Location\FetchWardsResource;
use App\Http\Resources\Web\SystemAdmin\Organization\Location\FetchLocationsResource;
use App\Http\Resources\Web\SystemAdmin\Organization\GetOrganizationResource;

class DisplayLocationsViewController extends Controller
{
    public function __construct(
        private GetOrganizationByIdAction $getOrganizationByIdAction,
        private ListCountriesAction $listCountriesAction,
        private ListStatesAction $listStatesAction,
        private ListLocalGovernmentAreasAction $listLocalGovernmentAreasAction,
        private ListWardsAction $listWardsAction,
        private ListLocationsAction $listLocationsAction,
    ) {}

    public function __invoke(FetchLocationsRequest $request, string $organizationId)
    {
        $organization = $this->getOrganizationByIdAction->execute($organizationId);

        if (is_null($organization)) {
            return redirect()->route('web.system-admin.organization.display-organizations-view');
        }

        $relationships = ['organization', 'country', 'state', 'localGovernmentArea', 'ward'];

        $validatedRequest = $request->validated();

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

        ['location_payload' => $locations, 'pagination_payload' => $paginationPayload] = $this->listLocationsAction->execute([
            'filter_record_options_payload' => [
                'organization_id' => $organizationId
            ],
            'pagination_payload' => [
                'page' => $validatedRequest['page'] ?? 1,
                'limit' => $validatedRequest['per_page'] ?? 100
            ]
        ], $relationships);

        $mutatedOrganization = GetOrganizationResource::make($organization)->resolve();

        $mutatedLocations = FetchLocationsResource::collection($locations)->resolve();

        return inertia('system-admin/organization/location/index', [
            'organization' => $mutatedOrganization,
            'wards' => $mutatedWards,
            'countries' => $mutatedCountries,
            'states' => $mutatedStates,
            'localGovernmentAreas' => $mutatedLocalGovernmentAreas,
            'locations' => $mutatedLocations,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
