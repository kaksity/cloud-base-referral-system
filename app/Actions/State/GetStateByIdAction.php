<?php

namespace App\Actions\State;

use App\Models\State;

class GetStateByIdAction
{
    public function __construct(
        private State $state
    ) {}

    public function execute(string $stateId)
    {
        return $this->state->where('id', $stateId)->first();
    }
}
