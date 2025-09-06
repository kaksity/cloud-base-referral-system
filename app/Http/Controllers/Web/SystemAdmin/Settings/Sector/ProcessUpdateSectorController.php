<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Sector;

use App\Actions\Sector\GetSectorByIdAction;
use App\Actions\Sector\UpdateSectorAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Sector\ProcessUpdateSectorRequest;

class ProcessUpdateSectorController extends Controller
{
    public function __construct(
        private GetSectorByIdAction $getSectorByIdAction,
        private UpdateSectorAction $updateSectorAction
    ) {}

    public function __invoke(ProcessUpdateSectorRequest $request, string $sectorId)
    {
        $sector = $this->getSectorByIdAction->execute($sectorId);

        if (is_null($sector)) {
            return back()->with('error', 'Sector record does not exists');
        }

        $this->updateSectorAction->execute([
            'id' => $sector->id,
            'data' => $request->validated()
        ]);

        return back()->with('success', 'Sector record was updated successfully');
    }
}
