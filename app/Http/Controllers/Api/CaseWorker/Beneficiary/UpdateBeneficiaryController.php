<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\GetBeneficiaryByIdAction;
use App\Actions\Beneficiary\UpdateBeneficiaryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Beneficiary\UpdateBeneficiaryRequest;

class UpdateBeneficiaryController extends Controller
{
    public function __construct(
        private GetBeneficiaryByIdAction $getBeneficiaryByIdAction,
        private UpdateBeneficiaryAction $updateBeneficiaryAction,
    ) {}

    public function __invoke(UpdateBeneficiaryRequest $request, string $beneficiaryId)
    {


        $beneficiary = $this->getBeneficiaryByIdAction->execute($beneficiaryId);

        if (is_null($beneficiary)) {
            return generateErrorApiMessage('Beneficiary does not exists', 404);
        }

        $validatedRequest = $request->validated();

        $this->updateBeneficiaryAction->execute([
            'id' => $beneficiaryId,
            'data' => $validatedRequest
        ]);

        return generateSuccessApiMessage('Beneficiary updated successfully', 200);
    }
}
