<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea;

use App\Actions\LocalGovernmentArea\GetLocalGovernmentAreaByIdAction;
use App\Actions\LocalGovernmentArea\UpdateLocalGovernmentAreaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\LocalGovernmentArea\ProcessUpdateLocalGovernmentAreaRequest;

class ProcessUpdateLocalGovernmentAreaController extends Controller
{
    public function __construct(
        private GetLocalGovernmentAreaByIdAction $getLocalGovernmentAreaByIdAction,
        private UpdateLocalGovernmentAreaAction $updateLocalGovernmentAreaAction
    ) {}

    public function __invoke(ProcessUpdateLocalGovernmentAreaRequest $request, string $localGovernmentAreaId)
    {
        $localGovernmentArea = $this->getLocalGovernmentAreaByIdAction->execute($localGovernmentAreaId);

        if (is_null($localGovernmentArea)) {
            return back()->with('error', 'Local Government Area record does not exists');
        }

        $this->updateLocalGovernmentAreaAction->execute([
            'id' => $localGovernmentArea->id,
            'data' => $request->validated()
        ]);

        return back()->with('success', 'Local Government Area record was updated successfully');
    }
}
