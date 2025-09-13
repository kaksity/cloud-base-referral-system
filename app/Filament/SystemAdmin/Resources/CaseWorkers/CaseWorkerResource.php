<?php

namespace App\Filament\SystemAdmin\Resources\CaseWorkers;

use App\Filament\SystemAdmin\Resources\CaseWorkers\Pages\CreateCaseWorker;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Pages\EditCaseWorker;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Pages\ListCaseWorkers;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Pages\ViewCaseWorker;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Schemas\CaseWorkerForm;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Schemas\CaseWorkerInfolist;
use App\Filament\SystemAdmin\Resources\CaseWorkers\Tables\CaseWorkersTable;
use App\Models\CaseWorker;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaseWorkerResource extends Resource
{
    protected static ?string $model = CaseWorker::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'case-worker';

    public static function form(Schema $schema): Schema
    {
        return CaseWorkerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CaseWorkerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CaseWorkersTable::configure($table);
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
            'index' => ListCaseWorkers::route('/'),
            'create' => CreateCaseWorker::route('/create'),
            'view' => ViewCaseWorker::route('/{record}'),
            'edit' => EditCaseWorker::route('/{record}/edit'),
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
