<?php

namespace App\Actions\State;

use App\Models\State;

class DeleteStateAction
{
    public function __construct(
        private State $state
    ) {}

    public function execute($stateId)
    {
        $this->state->where('id', $stateId)->delete();
    }
}
