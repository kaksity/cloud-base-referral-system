<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Profile\ProcessUpdateProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;

class ProcessUpdateProfileController extends Controller
{

    public function __invoke(ProcessUpdateProfileUpdateRequest $request): RedirectResponse
    {
        $loggedInSystemAdmin = auth('system-admin')->user()->fill($request->validated());


        if ($loggedInSystemAdmin->isDirty('email')) {
            $loggedInSystemAdmin->email_verified_at = null;
        }

        $loggedInSystemAdmin->save();

        return to_route('web.system-admin.settings.profile.display-profile-view');
    }
}
