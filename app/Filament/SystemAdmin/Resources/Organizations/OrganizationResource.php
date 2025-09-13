<?php

namespace App\Filament\SystemAdmin\Resources\Organizations;

use App\Filament\SystemAdmin\Resources\Organizations\Pages\CreateOrganization;
use App\Filament\SystemAdmin\Resources\Organizations\Pages\EditOrganization;
use App\Filament\SystemAdmin\Resources\Organizations\Pages\ListOrganizations;
use App\Filament\SystemAdmin\Resources\Organizations\Pages\ViewOrganization;
use App\Filament\SystemAdmin\Resources\Organizations\Schemas\CreateOrganizationForm;
use App\Filament\SystemAdmin\Resources\Organizations\Schemas\EditOrganizationForm;
use App\Filament\SystemAdmin\Resources\Organizations\Schemas\OrganizationForm;
use App\Filament\SystemAdmin\Resources\Organizations\Schemas\OrganizationInfolist;
use App\Filament\SystemAdmin\Resources\Organizations\Tables\OrganizationsTable;
use App\Models\Organization;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'organization';

    public static function form(Schema $schema): Schema
    {
        $operations = [
            'create' => CreateOrganizationForm::configure($schema),
            'edit' => EditOrganizationForm::configure($schema)
        ];

        return $operations[$schema->getOperation()];
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrganizationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationsTable::configure($table);
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
            'index' => ListOrganizations::route('/'),
            'create' => CreateOrganization::route('/create'),
            'view' => ViewOrganization::route('/{record}'),
            'edit' => EditOrganization::route('/{record}/edit'),
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
