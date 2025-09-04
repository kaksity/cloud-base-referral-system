<?php

namespace App\Actions\Ward;

use App\Models\Ward;

class GetWardByIdAction
{
    public function __construct(
        private Ward $ward
    ) {}

    public function execute(string $wardId)
    {
        return $this->ward->where('id', $wardId)->first();
    }
}
