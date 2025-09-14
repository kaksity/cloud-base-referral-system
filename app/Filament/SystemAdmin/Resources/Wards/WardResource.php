<?php

namespace App\Filament\SystemAdmin\Resources\Wards;

use App\Filament\SystemAdmin\Resources\Wards\Pages\CreateWard;
use App\Filament\SystemAdmin\Resources\Wards\Pages\EditWard;
use App\Filament\SystemAdmin\Resources\Wards\Pages\ListWards;
use App\Filament\SystemAdmin\Resources\Wards\Pages\ViewWard;
use App\Filament\SystemAdmin\Resources\Wards\Schemas\WardForm;
use App\Filament\SystemAdmin\Resources\Wards\Schemas\WardInfolist;
use App\Filament\SystemAdmin\Resources\Wards\Tables\WardsTable;
use App\Models\Ward;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WardResource extends Resource
{
    protected static ?string $model = Ward::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ward';

    public static function form(Schema $schema): Schema
    {
        return WardForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WardInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WardsTable::configure($table);
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
            'index' => ListWards::route('/'),
            'create' => CreateWard::route('/create'),
            'view' => ViewWard::route('/{record}'),
            'edit' => EditWard::route('/{record}/edit'),
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
