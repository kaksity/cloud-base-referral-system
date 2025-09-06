<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Country;

use App\Actions\Country\CreateCountryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Country\ProcessCreateCountryRequest;

class ProcessCreateCountryController extends Controller
{
    public function __construct(
        private CreateCountryAction $createCountryAction
    ) {}

    public function __invoke(ProcessCreateCountryRequest $request)
    {
        $this->createCountryAction->execute($request->validated());

        return back()->with('success', 'Country record was created successfully');
    }
}
