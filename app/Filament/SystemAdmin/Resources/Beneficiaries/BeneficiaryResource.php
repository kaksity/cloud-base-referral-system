<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries;

use App\Filament\SystemAdmin\Resources\Beneficiaries\Pages\CreateBeneficiary;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Pages\EditBeneficiary;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Pages\ListBeneficiaries;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Pages\ViewBeneficiary;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Schemas\BeneficiaryForm;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Schemas\BeneficiaryInfolist;
use App\Filament\SystemAdmin\Resources\Beneficiaries\Tables\BeneficiariesTable;
use App\Models\Beneficiary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'beneficiary';

    public static function form(Schema $schema): Schema
    {
        return BeneficiaryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BeneficiaryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeneficiariesTable::configure($table);
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
            'index' => ListBeneficiaries::route('/'),
            'create' => CreateBeneficiary::route('/create'),
            'view' => ViewBeneficiary::route('/{record}'),
            'edit' => EditBeneficiary::route('/{record}/edit'),
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
