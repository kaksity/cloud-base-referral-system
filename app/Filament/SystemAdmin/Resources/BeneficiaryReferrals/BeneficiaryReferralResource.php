<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals;

use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages\CreateBeneficiaryReferral;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages\EditBeneficiaryReferral;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages\ListBeneficiaryReferrals;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Pages\ViewBeneficiaryReferral;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Schemas\BeneficiaryReferralForm;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Schemas\BeneficiaryReferralInfolist;
use App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Tables\BeneficiaryReferralsTable;
use App\Models\BeneficiaryReferral;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeneficiaryReferralResource extends Resource
{
    protected static ?string $model = BeneficiaryReferral::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'beneficiary-referral';

    public static function form(Schema $schema): Schema
    {
        return BeneficiaryReferralForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BeneficiaryReferralInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeneficiaryReferralsTable::configure($table);
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
            'index' => ListBeneficiaryReferrals::route('/'),
            'create' => CreateBeneficiaryReferral::route('/create'),
            'view' => ViewBeneficiaryReferral::route('/{record}'),
            'edit' => EditBeneficiaryReferral::route('/{record}/edit'),
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
