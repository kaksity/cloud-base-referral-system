<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea;

use App\Actions\LocalGovernmentArea\CreateLocalGovernmentAreaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\LocalGovernmentArea\ProcessCreateLocalGovernmentAreaRequest;

class ProcessCreateLocalGovernmentAreaController extends Controller
{
    public function __construct(
        private CreateLocalGovernmentAreaAction $createLocalGovernmentAreaAction
    ) {}

    public function __invoke(ProcessCreateLocalGovernmentAreaRequest $request)
    {
        $this->createLocalGovernmentAreaAction->execute($request->validated());

        return back()->with('success', 'Local Government Area record was created successfully');
    }
}
