<?php

namespace App\Http\Controllers\Api\CaseWorker\Authentication;

use App\Actions\CaseWorker\GetCaseWorkerByEmailAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Authentication\LoginRequest;
use App\Http\Resources\Api\CaseWorker\Authentication\LoginResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(
        private GetCaseWorkerByEmailAction $getCaseWorkerByEmailAction
    ) {}

    public function __invoke(LoginRequest $request)
    {
        $caseWorker = $this->getCaseWorkerByEmailAction->execute($request->email);

        if (is_null($caseWorker)) {
            return generateErrorApiMessage('Invalid login credentials');
        }

        if (Hash::check($request->password, $caseWorker->password) === false) {
            return generateErrorApiMessage('Invalid login credentials');
        }

        if ($caseWorker->status !== 'active') {
            return generateErrorApiMessage('You account has been deactivated. Kindly contact your organization', 403);
        }

        $responsePayload = new LoginResource($caseWorker);

        return generateSuccessApiMessage('Case worker logged in successfully', 200, $responsePayload);
    }
}
