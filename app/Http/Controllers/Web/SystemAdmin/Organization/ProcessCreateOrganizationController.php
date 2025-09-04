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


        DB::transaction(function () use ($request) {

            $loggedInSystemAdmin = auth('web')->user();

            $organization = $this->createOrganizationAction->execute([
                'added_by_system_admin_id' => $loggedInSystemAdmin->id,
                'name' => $request->organization_name,
            ]);

            $password = generateRandomString();
            $this->createOrganizationAdminAction->execute([
                'organization_id' => $organization->id,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            return ['created_organization' => $organization, 'generated_password' => $password];
        });

        return back();
    }
}
