<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Ward;

use App\Actions\Ward\GetWardByIdAction;
use App\Actions\Ward\DeleteWardAction;
use App\Http\Controllers\Controller;

class ProcessDeleteWardController extends Controller
{
    public function __construct(
        private GetWardByIdAction $getWardByIdAction,
        private DeleteWardAction $deleteWardAction
    ) {}

    public function __invoke(string $wardId)
    {
        $ward = $this->getWardByIdAction->execute($wardId);

        if (is_null($ward)) {
            return back()->with('error', 'Ward record does not exists');
        }

        $this->deleteWardAction->execute($wardId);

        return back()->with('success', 'Ward record was deleted successfully');
    }
}
