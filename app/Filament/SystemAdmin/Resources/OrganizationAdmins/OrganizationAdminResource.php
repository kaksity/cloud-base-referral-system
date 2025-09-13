<?php

namespace App\Filament\SystemAdmin\Resources\OrganizationAdmins;

use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages\CreateOrganizationAdmin;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages\EditOrganizationAdmin;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages\ListOrganizationAdmins;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Pages\ViewOrganizationAdmin;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Schemas\OrganizationAdminForm;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Schemas\OrganizationAdminInfolist;
use App\Filament\SystemAdmin\Resources\OrganizationAdmins\Tables\OrganizationAdminsTable;
use App\Models\OrganizationAdmin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationAdminResource extends Resource
{
    protected static ?string $model = OrganizationAdmin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'organization-admin';

    public static function form(Schema $schema): Schema
    {
        return OrganizationAdminForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrganizationAdminInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationAdminsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizationAdmins::route('/'),
            'create' => CreateOrganizationAdmin::route('/create'),
            'view' => ViewOrganizationAdmin::route('/{record}'),
            'edit' => EditOrganizationAdmin::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
