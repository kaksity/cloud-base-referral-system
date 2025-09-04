<?php

namespace App\Actions\Ward;

use App\Models\Ward;

class DeleteWardAction
{
    public function __construct(
        private Ward $ward
    ) {}

    public function execute($wardId)
    {
        $this->ward->where('id', $wardId)->delete();
    }
}
