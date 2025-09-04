<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization\About;

use App\Actions\Organization\GetOrganizationByIdAction;
use App\Actions\Organization\UpdateOrganizationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Organization\About\ProcessUpdateOrganizationBasicInformationRequest;

class ProcessUpdateOrganizationBasicInformationController extends Controller
{
    public function __construct(
        private GetOrganizationByIdAction $getOrganizationByIdAction,
        private UpdateOrganizationAction $updateOrganizationAction
    ) {}
    public function __invoke(ProcessUpdateOrganizationBasicInformationRequest $request, string $organizationId)
    {

        $validatedRequest = $request->validated();

        $organization = $this->getOrganizationByIdAction->execute($organizationId);

        if (is_null($organization)) {
            return redirect()->route('web.system-admin.organization.display-organizations-view');
        }

        $this->updateOrganizationAction->execute([
            'id' => $organizationId,
            'data' => $validatedRequest
        ]);

        return back()->with('success', 'Organization Basic Information updated successfully');
    }
}
