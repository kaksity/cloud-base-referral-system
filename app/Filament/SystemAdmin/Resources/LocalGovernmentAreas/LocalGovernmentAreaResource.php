<?php

namespace App\Filament\SystemAdmin\Resources\LocalGovernmentAreas;

use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages\CreateLocalGovernmentArea;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages\EditLocalGovernmentArea;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages\ListLocalGovernmentAreas;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Pages\ViewLocalGovernmentArea;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Schemas\LocalGovernmentAreaForm;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Schemas\LocalGovernmentAreaInfolist;
use App\Filament\SystemAdmin\Resources\LocalGovernmentAreas\Tables\LocalGovernmentAreasTable;
use App\Models\LocalGovernmentArea;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LocalGovernmentAreaResource extends Resource
{
    protected static ?string $model = LocalGovernmentArea::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'local-government-area';

    public static function form(Schema $schema): Schema
    {
        return LocalGovernmentAreaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LocalGovernmentAreaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalGovernmentAreasTable::configure($table);
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
            'index' => ListLocalGovernmentAreas::route('/'),
            'create' => CreateLocalGovernmentArea::route('/create'),
            'view' => ViewLocalGovernmentArea::route('/{record}'),
            'edit' => EditLocalGovernmentArea::route('/{record}/edit'),
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
