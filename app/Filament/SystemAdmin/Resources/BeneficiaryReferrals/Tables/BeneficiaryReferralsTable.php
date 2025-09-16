<?php

namespace App\Filament\SystemAdmin\Resources\BeneficiaryReferrals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BeneficiaryReferralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('beneficiary_id')
                    ->label('Beneficiary')
                    ->formatStateUsing(fn($record) => trim(
                        "{$record->beneficiary?->first_name} {$record->beneficiary?->middle_name} {$record->beneficiary?->last_name}"
                    ))
                    ->searchable(),
                TextColumn::make('organization.name')->label('Organization')
                    ->searchable(),
                TextColumn::make('location_id')
                    ->label('Location')
                    ->formatStateUsing(fn($record) => trim(
                        "{$record->location->name}, {$record->location->ward->name}, {$record->location->localGovernmentArea->name}, {$record->location->state->name}"
                    ))
                    ->searchable(),
                TextColumn::make('services')
                    ->label('Services')
                    ->badge()
                    ->separator(', ')
                    ->formatStateUsing(function ($state, $record) {
                        $services = json_decode($record->services, true);
                        if (is_array($services)) {
                            return $services;
                        }
                    })
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
