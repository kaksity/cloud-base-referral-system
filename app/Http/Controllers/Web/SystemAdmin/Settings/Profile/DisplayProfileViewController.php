<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class DisplayProfileViewController extends Controller
{

    public function __invoke()
    {
        $loggedInUser = auth('system-admin')->user();

        return inertia('system-admin/settings/profile/index', [
            'mustVerifyEmail' => $loggedInUser instanceof MustVerifyEmail,
            'status' => request()->session()->get('status'),
        ]);
    }
}
