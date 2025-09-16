<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\CreateBeneficiaryAction;
use App\Actions\Beneficiary\UpdateBeneficiaryAction;
use App\Actions\BeneficiaryReferral\CreateBeneficiaryReferralAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Beneficiary\CreateBeneficiaryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateBeneficiaryController extends Controller
{
    public function __construct(
        private CreateBeneficiaryAction $createBeneficiaryAction,
        private CreateBeneficiaryReferralAction $createBeneficiaryReferralAction,
    ) {}

    public function __invoke(CreateBeneficiaryRequest $request)
    {
        DB::transaction(function () use ($request) {
            $loggedInCaseWorker = auth('case-worker')->user();

            $validatedRequest = $request->validated();

            $beneficiaryId = Str::uuid();

            $createBeneficiaryRecordOptions = array_merge($validatedRequest['basic_information'], [
                    'id' => $beneficiaryId,
                    'added_by_case_worker_id' => $loggedInCaseWorker->id,
                    'location_id' => $loggedInCaseWorker->current_location_id,
                    'other_attributes' => json_encode($validatedRequest['basic_information']['other_attributes'] ?? [])
            ]);

            if ($validatedRequest['referral']['organization_id']) {
                $this->createBeneficiaryReferralAction->execute(
                    array_merge($validatedRequest['referral'], [
                        'beneficiary_id' => $beneficiaryId,
                        'location_id' => $loggedInCaseWorker->current_location_id,
                        'services' => json_encode($validatedRequest['referral']['services'] ?? [])
                    ])
                );

                $createBeneficiaryRecordOptions['status'] = 'referred';
            }

            $this->createBeneficiaryAction->execute(
                $createBeneficiaryRecordOptions
            );
        });


        return generateSuccessApiMessage('Beneficiary was created successfully', 201);
    }
}
