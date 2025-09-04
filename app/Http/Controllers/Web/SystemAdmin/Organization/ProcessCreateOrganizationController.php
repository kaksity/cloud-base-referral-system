<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization;

use App\Actions\Organization\CreateOrganizationAction;
use App\Actions\OrganizationAdmin\CreateOrganizationAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Organization\ProcessCreateOrganizationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProcessCreateOrganizationController extends Controller
{
    public function __construct(
        private CreateOrganizationAction $createOrganizationAction,
        private CreateOrganizationAdminAction $createOrganizationAdminAction,
    ) {}
    public function __invoke(ProcessCreateOrganizationRequest $request)
    {

        $validatedRequest = $request->validated();

        ['created_organization' => $organization] = DB::transaction(function () use ($validatedRequest) {

            $loggedInSystemAdmin = auth('system-admin')->user();

            $organization = $this->createOrganizationAction->execute(
                array_merge($validatedRequest['organization'], [
                    'added_by_system_admin_id' => $loggedInSystemAdmin->id,
                ])
            );

            $password = generateRandomString();

            $this->createOrganizationAdminAction->execute(
                array_merge($validatedRequest['organization_admin'], [
                    'organization_id' => $organization->id,
                    'password' => Hash::make($password),
                ])
            );

            return ['created_organization' => $organization, 'generated_password' => $password];
        });

        return redirect()->route('web.system-admin.organization.display-organization-view', $organization->id);
    }
}
