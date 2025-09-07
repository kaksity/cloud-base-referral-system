<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Ward;

use App\Actions\Ward\CreateWardAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Ward\ProcessCreateWardRequest;

class ProcessCreateWardController extends Controller
{
    public function __construct(
        private CreateWardAction $createWardAction
    ) {}

    public function __invoke(ProcessCreateWardRequest $request)
    {
        $this->createWardAction->execute($request->validated());

        return back()->with('success', 'Ward record was created successfully');
    }
}
