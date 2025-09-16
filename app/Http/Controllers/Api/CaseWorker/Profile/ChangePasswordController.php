<?php

namespace App\Http\Controllers\Api\CaseWorker\Profile;

use App\Actions\SystemAdmin\UpdateSystemAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Profile\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct(
        private UpdateSystemAdminAction $updateSystemAdminAction
    ) {}

    public function __invoke(ChangePasswordRequest $request)
    {
        $loggedInUser = auth('case-worker')->user();

        $validatedRequest = $request->validated();

        $this->updateSystemAdminAction->execute([
            'id' => $loggedInUser->id,
            'data' => [
                'password' => Hash::make($validatedRequest['password'])
            ]
        ]);

        return generateSuccessApiMessage('Password was changed successfully');
    }
}
