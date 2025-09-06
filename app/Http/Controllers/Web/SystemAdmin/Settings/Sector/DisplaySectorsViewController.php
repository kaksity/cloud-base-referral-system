<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Sector;

use App\Actions\Sector\ListSectorsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Sector\FetchSectorsRequest;
use App\Http\Resources\Web\SystemAdmin\Settings\Sector\FetchSectorsResource;

class DisplaySectorsViewController extends Controller
{
    public function __construct(
        private ListSectorsAction $listSectorsAction
    ) {}

    public function __invoke(FetchSectorsRequest $request)
    {
        ['sector_payload' => $sectors, 'pagination_payload' => $paginationPayload] = $this->listSectorsAction->execute([
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 20,
            ]
        ]);

        $mutatedSectors = FetchSectorsResource::collection($sectors)->resolve();

        return inertia('system-admin/settings/sectors/index', [
            'sectors' => $mutatedSectors,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
