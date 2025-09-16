<?php

namespace App\Http\Controllers\Api\CaseWorker\Authentication;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        
        // auth('case-worker')->logout();

        return generateSuccessApiMessage('Case worker was logged out successfully');
    }
}
