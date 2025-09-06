<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\State;

use App\Actions\State\GetStateByIdAction;
use App\Actions\State\UpdateStateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\State\ProcessUpdateStateRequest;

class ProcessUpdateStateController extends Controller
{
    public function __construct(
        private GetStateByIdAction $getStateByIdAction,
        private UpdateStateAction $updateStateAction
    ) {}

    public function __invoke(ProcessUpdateStateRequest $request, string $stateId)
    {
        $state = $this->getStateByIdAction->execute($stateId);

        if (is_null($state)) {
            return back()->with('error', 'State record does not exists');
        }

        $this->updateStateAction->execute([
            'id' => $state->id,
            'data' => $request->validated()
        ]);

        return back()->with('success', 'State record was updated successfully');
    }
}
