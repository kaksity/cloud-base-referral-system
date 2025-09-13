<?php

namespace App\Filament\SystemAdmin\Resources\Organizations\Pages;

use App\Actions\OrganizationAdmin\CreateOrganizationAdminAction;
use App\Filament\SystemAdmin\Resources\Organizations\OrganizationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateOrganization extends CreateRecord
{
    protected static string $resource = OrganizationResource::class;
    private array $organizationAdmin = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $loggedInSystemAdmin = auth('system-admin')->user();

        $data['organization']['added_by_system_admin_id'] = $loggedInSystemAdmin->id;

        $this->organizationAdmin = $data['organization_admin'];

        return $data['organization'];
    }

    public function afterCreate(): void
    {
        $createOrganizationAdminAction = app(CreateOrganizationAdminAction::class);

        $password = generateRandomString();

        $createOrganizationAdminAction->execute(
            array_merge($this->organizationAdmin, [
                'organization_id' => $this->record->id,
                'added_by_system_admin_id' => $this->record->added_by_system_admin_id,
                'password' => Hash::make($password),
            ])
        );
    }
}
