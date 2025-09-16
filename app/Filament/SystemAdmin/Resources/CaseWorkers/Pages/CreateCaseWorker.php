<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers\Pages;

use App\Filament\SystemAdmin\Resources\CaseWorkers\CaseWorkerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateCaseWorker extends CreateRecord
{
    protected static string $resource = CaseWorkerResource::class;

    private string $generatedPassword = '';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $loggedInSystemAdmin = auth('system-admin')->user();

        $data['added_by_system_admin_id'] = $loggedInSystemAdmin->id;

        $this->generatedPassword =  'password';
        // generateRandomString();

        $data['password'] = Hash::make($this->generatedPassword);

        return $data;
    }

    public function afterCreate(): void
    {
        // Dispatch an email containing login credentials
    }
}
