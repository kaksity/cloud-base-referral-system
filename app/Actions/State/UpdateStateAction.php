<?php

namespace App\Actions\State;

use App\Models\State;

class UpdateStateAction
{
    public function __construct(
        private State $state
    ) {}

    public function execute($updateStateRecordOptions)
    {
        $id = $updateStateRecordOptions['id'];
        $data = $updateStateRecordOptions['data'];

        $this->state->where('id', $id)->update($data);
    }
}
