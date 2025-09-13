<?php

namespace App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages;

use App\Filament\SystemAdmin\Resources\OrganizationAdmins\OrganizationAdminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganizationAdmins extends ListRecords
{
    protected static string $resource = OrganizationAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
