<?php

namespace App\Filament\Admin\Resources\MenuResource\RelationManagers;

use App\Filament\Admin\Resources\PlateResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlatesRelationManager extends RelationManager
{
    protected static string $relationship = 'plates';

    public function form(Form $form): Form
    {
        return PlateResource::form($form);
    }

    public function table(Table $table): Table
    {
        return PlateResource::table($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
