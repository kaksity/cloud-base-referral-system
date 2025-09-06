<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\State;

use App\Actions\State\CreateStateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\State\ProcessCreateStateRequest;

class ProcessCreateStateController extends Controller
{
    public function __construct(
        private CreateStateAction $createStateAction
    ) {}

    public function __invoke(ProcessCreateStateRequest $request)
    {
        $this->createStateAction->execute($request->validated());

        return back()->with('success', 'State record was created successfully');
    }
}
