<?php

namespace App\Actions\State;

use App\Models\State;

class CreateStateAction
{
    public function __construct(
        private State $state
    ) {}

    public function execute(array $createStateRecordOptions)
    {
        return $this->state->create($createStateRecordOptions);
    }
}
