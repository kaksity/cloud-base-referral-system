<?php

namespace App\Http\Controllers\Web\SystemAdmin\Authentication;

use App\Actions\SystemAdmin\GetSystemAdminByEmailAction;
use App\Actions\SystemAdmin\GetSystemAdminByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Authentication\ProcessLoginRequest;
use Illuminate\Support\Facades\Hash;

class ProcessLoginController extends Controller
{
    public function __construct(
        private GetSystemAdminByEmailAction $getSystemAdminByEmailAction
    ) {}
    public function __invoke(ProcessLoginRequest $request)
    {
        $systemAdmin = $this->getSystemAdminByEmailAction->execute($request->email);

        if (is_null($systemAdmin)) {
            return back()->with('error', 'Invalid login credentials');
        }

        if (Hash::check($request->password, $systemAdmin->password) === false) {
            return back()->with('error', 'Invalid login credentials');
        }

        auth('system-admin')->login($systemAdmin);

        return redirect()->route('web.system-admin.dashboard.display-dashboard-view');
    }
}
