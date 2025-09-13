<?php

namespace App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages;

use App\Filament\SystemAdmin\Resources\OrganizationAdmins\OrganizationAdminResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationAdmin extends EditRecord
{
    protected static string $resource = OrganizationAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
