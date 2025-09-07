<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea;

use App\Actions\LocalGovernmentArea\GetLocalGovernmentAreaByIdAction;
use App\Actions\LocalGovernmentArea\DeleteLocalGovernmentAreaAction;
use App\Http\Controllers\Controller;

class ProcessDeleteLocalGovernmentAreaController extends Controller
{
    public function __construct(
        private GetLocalGovernmentAreaByIdAction $getLocalGovernmentAreaByIdAction,
        private DeleteLocalGovernmentAreaAction $deleteLocalGovernmentAreaAction
    ) {}

    public function __invoke(string $localGovernmentAreaId)
    {
        $localGovernmentArea = $this->getLocalGovernmentAreaByIdAction->execute($localGovernmentAreaId);

        if (is_null($localGovernmentArea)) {
            return back()->with('error', 'Local Government Area record does not exists');
        }

        $this->deleteLocalGovernmentAreaAction->execute($localGovernmentAreaId);

        return back()->with('success', 'Local Government Area record was deleted successfully');
    }
}
