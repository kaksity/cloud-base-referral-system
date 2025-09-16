<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\GetBeneficiaryByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CaseWorker\Beneficiary\GetBeneficiaryResource;

class GetBeneficiaryController extends Controller
{
    public function __construct(private GetBeneficiaryByIdAction $getBeneficiaryByIdAction) {}

    public function __invoke(string $beneficiaryId)
    {
        $relationships = ['addedByCaseWorker', 'location'];

        $beneficiary = $this->getBeneficiaryByIdAction->execute($beneficiaryId, $relationships);

        if (is_null($beneficiary)) {
            return generateErrorApiMessage('Beneficiary does not exists', 404);
        }

        $mutatedBeneficiary = new GetBeneficiaryResource($beneficiary);

        return generateSuccessApiMessage('Fetched beneficiary record successfully', 200, $mutatedBeneficiary);
    }
}
