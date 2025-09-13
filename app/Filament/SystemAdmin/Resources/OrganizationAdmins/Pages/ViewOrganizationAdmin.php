<?php

namespace App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages;

use App\Filament\SystemAdmin\Resources\OrganizationAdmins\OrganizationAdminResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrganizationAdmin extends ViewRecord
{
    protected static string $resource = OrganizationAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
