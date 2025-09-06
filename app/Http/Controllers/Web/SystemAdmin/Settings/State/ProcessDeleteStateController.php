<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\State;

use App\Actions\State\GetStateByIdAction;
use App\Actions\State\DeleteStateAction;
use App\Http\Controllers\Controller;

class ProcessDeleteStateController extends Controller
{
    public function __construct(
        private GetStateByIdAction $getStateByIdAction,
        private DeleteStateAction $deleteStateAction
    ) {}

    public function __invoke(string $stateId)
    {
        $state = $this->getStateByIdAction->execute($stateId);

        if (is_null($state)) {
            return back()->with('error', 'State record does not exists');
        }

        $this->deleteStateAction->execute($stateId);

        return back()->with('success', 'State record was deleted successfully');
    }
}
