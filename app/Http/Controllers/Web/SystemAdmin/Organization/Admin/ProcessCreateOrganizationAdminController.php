<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization\Admin;

use App\Actions\OrganizationAdmin\CreateOrganizationAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Organization\Admin\ProcessCreateOrganizationAdminRequest;
use Illuminate\Support\Facades\Hash;

class ProcessCreateOrganizationAdminController extends Controller
{
    public function __construct(
        private CreateOrganizationAdminAction $createOrganizationAdminAction,
    ) {}
    public function __invoke(ProcessCreateOrganizationAdminRequest $request)
    {
        $validatedRequest = $request->validated();

        $loggedInSystemAdmin = auth('system-admin')->user();

        $password = generateRandomString();

        $this->createOrganizationAdminAction->execute(
            array_merge($validatedRequest, [
                'added_by_system_admin_id' => $loggedInSystemAdmin->id,
                'password' => Hash::make($password),
            ])
        );

        return back()->with('success', 'New Admin record was added successfully');
    }
}
