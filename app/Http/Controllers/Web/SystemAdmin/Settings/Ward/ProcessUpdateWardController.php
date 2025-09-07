<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Ward;

use App\Actions\Ward\GetWardByIdAction;
use App\Actions\Ward\UpdateWardAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Settings\Ward\ProcessUpdateWardRequest;

class ProcessUpdateWardController extends Controller
{
    public function __construct(
        private GetWardByIdAction $getWardByIdAction,
        private UpdateWardAction $updateWardAction
    ) {}

    public function __invoke(ProcessUpdateWardRequest $request, string $wardId)
    {
        $ward = $this->getWardByIdAction->execute($wardId);

        if (is_null($ward)) {
            return back()->with('error', 'Ward record does not exists');
        }

        $this->updateWardAction->execute([
            'id' => $ward->id,
            'data' => $request->validated()
        ]);

        return back()->with('success', 'Ward record was updated successfully');
    }
}
