<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Country;

use App\Actions\Country\GetCountryByIdAction;
use App\Actions\Country\UpdateCountryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Country\ProcessUpdateCountryRequest;

class ProcessUpdateCountryController extends Controller
{
    public function __construct(
        private GetCountryByIdAction $getCountryByIdAction,
        private UpdateCountryAction $updateCountryAction
    ) {}

    public function __invoke(ProcessUpdateCountryRequest $request, string $countryId)
    {
        $country = $this->getCountryByIdAction->execute($countryId);

        if (is_null($country)) {
            return back()->with('error', 'Country record does not exists');
        }

        $this->updateCountryAction->execute([
            'id' => $country->id,
            'data' => $request->validated()
        ]);

        return back()->with('success', 'Country record was updated successfully');
    }
}
