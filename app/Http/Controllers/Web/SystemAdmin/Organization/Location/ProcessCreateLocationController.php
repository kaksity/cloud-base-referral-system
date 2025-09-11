<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization\Location;

use App\Actions\Location\CreateLocationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Organization\Location\ProcessCreateLocationRequest;

class ProcessCreateLocationController extends Controller
{
    public function __construct(
        private CreateLocationAction $createLocationAction,
    ) {}
    public function __invoke(ProcessCreateLocationRequest $request)
    {
        $validatedRequest = $request->validated();

        $this->createLocationAction->execute(
            $validatedRequest
        );

        return back()->with('success', 'New Location record was added successfully');
    }
}
