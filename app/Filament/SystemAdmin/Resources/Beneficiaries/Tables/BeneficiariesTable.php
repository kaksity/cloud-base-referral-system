<?php

namespace App\Filament\SystemAdmin\Resources\Beneficiaries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BeneficiariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('Beneficiary')
                    ->formatStateUsing(fn($record) => trim(
                        "{$record->first_name} {$record->middle_name} {$record->last_name}"
                    ))
                    ->searchable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('added_by_case_worker_id')
                    ->label('Add By Case Worker')
                    ->formatStateUsing(fn($record) => trim(
                        "{$record->addedByCaseWorker->first_name} {$record->addedByCaseWorker->middle_name} {$record->addedByCaseWorker->last_name}"
                    ))
                    ->searchable(),
                TextColumn::make('location_id')
                    ->label('Location')
                    ->formatStateUsing(fn($record) => trim(
                        "{$record->location->name}, {$record->location->ward->name}, {$record->location->localGovernmentArea->name}, {$record->location->state->name}"
                    ))
                    ->searchable(),
                TextColumn::make('age_group')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
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
