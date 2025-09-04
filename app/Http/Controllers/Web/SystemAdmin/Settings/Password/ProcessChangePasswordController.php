<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Password;

use App\Actions\SystemAdmin\UpdateSystemAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Password\ProcessChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProcessChangePasswordController extends Controller
{
    public function __construct(
        private UpdateSystemAdminAction $updateSystemAdminAction
    ) {}

    public function __invoke(ProcessChangePasswordRequest $request)
    {
        $loggedInSystemAdmin = auth('system-admin')->user();

        $validatedRequest = $request->validated();

        $this->updateSystemAdminAction->execute([
            'id' => $loggedInSystemAdmin->id,
            'data' => [
                'password' => Hash::make($validatedRequest['password'])
            ]
        ]);

        return back();
    }
}
