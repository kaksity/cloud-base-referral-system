<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Sector;

use App\Actions\Sector\CreateSectorAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Sector\ProcessCreateSectorRequest;

class ProcessCreateSectorController extends Controller
{
    public function __construct(
        private CreateSectorAction $createSectorAction
    ) {}

    public function __invoke(ProcessCreateSectorRequest $request)
    {
        $this->createSectorAction->execute($request->validated());

        return back()->with('success', 'Sector record was created successfully');
    }
}
