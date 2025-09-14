<?php

namespace App\Filament\SystemAdmin\Resources\Sectors;

use App\Filament\SystemAdmin\Resources\Sectors\Pages\CreateSector;
use App\Filament\SystemAdmin\Resources\Sectors\Pages\EditSector;
use App\Filament\SystemAdmin\Resources\Sectors\Pages\ListSectors;
use App\Filament\SystemAdmin\Resources\Sectors\Pages\ViewSector;
use App\Filament\SystemAdmin\Resources\Sectors\Schemas\SectorForm;
use App\Filament\SystemAdmin\Resources\Sectors\Schemas\SectorInfolist;
use App\Filament\SystemAdmin\Resources\Sectors\Tables\SectorsTable;
use App\Models\Sector;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectorResource extends Resource
{
    protected static ?string $model = Sector::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'sector';

    public static function form(Schema $schema): Schema
    {
        return SectorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SectorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SectorsTable::configure($table);
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
            'index' => ListSectors::route('/'),
            'create' => CreateSector::route('/create'),
            'view' => ViewSector::route('/{record}'),
            'edit' => EditSector::route('/{record}/edit'),
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
