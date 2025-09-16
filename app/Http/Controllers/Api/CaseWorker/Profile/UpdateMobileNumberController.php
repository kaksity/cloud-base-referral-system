<?php

namespace App\Http\Controllers\Api\CaseWorker\Profile;

use App\Actions\CaseWorker\UpdateCaseWorkerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Profile\UpdateMobileNumberRequest;

class UpdateMobileNumberController extends Controller
{
    public function __construct(
        private UpdateCaseWorkerAction $updateCaseWorkerAction
    ) {}
    public function __invoke(UpdateMobileNumberRequest $request)
    {
        $loggedInUser = auth('case-worker')->user();

        $validatedRequest = $request->validated();

        $this->updateCaseWorkerAction->execute([
            'id' => $loggedInUser->id,
            'data' => $validatedRequest
        ]);

        return generateSuccessApiMessage('Case worker full name updated successfully', 200);
    }
}
