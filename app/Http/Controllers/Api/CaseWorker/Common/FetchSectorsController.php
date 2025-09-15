<?php

namespace App\Http\Controllers\Api\CaseWorker\Common;

use App\Actions\Sector\ListSectorsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Common\FetchSectorsRequest;
use App\Http\Resources\Api\CaseWorker\Common\FetchSectorsResource;

class FetchSectorsController extends Controller
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

        $mutatedSectors = FetchSectorsResource::collection($sectors);

        $responsePayload = [
            'sectors' => $mutatedSectors,
            'pagination_payload' => $paginationPayload
        ];
        return generateSuccessApiMessage('Fetched sectors successfully', 200, $responsePayload);
    }
}
