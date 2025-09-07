<?php

namespace App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\About;

use App\Actions\OrganizationAdmin\GetOrganizationAdminByIdAction;
use App\Actions\OrganizationAdmin\UpdateOrganizationAdminAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\OrganizationAdmin\About\ProcessUpdatePersonalInformationRequest;

class ProcessUpdatePersonalInformationController extends Controller
{
    public function __construct(
        private GetOrganizationAdminByIdAction $getOrganizationAdminByIdAction,
        private UpdateOrganizationAdminAction $updateOrganizationAdminAction
    ) {}
    public function __invoke(ProcessUpdatePersonalInformationRequest $request, string $organizationAdminId)
    {
        $validatedRequest = $request->validated();

        $organizationAdmin = $this->getOrganizationAdminByIdAction->execute($organizationAdminId);

        if (is_null($organizationAdmin)) {
            return redirect()->route('web.system-admin.organization-admin.display-organization-admins-view');
        }

        $this->updateOrganizationAdminAction->execute([
            'id' => $organizationAdminId,
            'data' => $validatedRequest
        ]);

        return back()->with('success', 'OrganizationAdmin Basic Information updated successfully');
    }
}
