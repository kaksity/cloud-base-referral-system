<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Sector;

use App\Actions\Sector\GetSectorByIdAction;
use App\Actions\Sector\DeleteSectorAction;
use App\Http\Controllers\Controller;

class ProcessDeleteSectorController extends Controller
{
    public function __construct(
        private GetSectorByIdAction $getSectorByIdAction,
        private DeleteSectorAction $deleteSectorAction
    ) {}

    public function __invoke(string $sectorId)
    {
        $sector = $this->getSectorByIdAction->execute($sectorId);

        if (is_null($sector)) {
            return back()->with('error', 'Sector record does not exists');
        }

        $this->deleteSectorAction->execute($sectorId);

        return back()->with('success', 'Sector record was deleted successfully');
    }
}
