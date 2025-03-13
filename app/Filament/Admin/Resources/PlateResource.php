<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PlateResource\Pages;
use App\Filament\Admin\Resources\PlateResource\RelationManagers;
use App\Models\Plate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlateResource extends Resource
{
    protected static ?string $model = Plate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null)
                    ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->createOptionForm(function ($livewire) {
                        return [
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('description')
                                ->maxLength(255)
                                ->default(null),
                            Forms\Components\Toggle::make('is_active')
                                ->default(true)
                                ->required(),
                        ];
                    })
                    ->default(null),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Section::make('Images')
                    ->collapsed(true)
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->image()
                            ->disk('public')
                            ->directory('plates')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('images')
                            ->image()
                            ->disk('public')
                            ->directory('plates')
                            ->multiple()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePlates::route('/'),
        ];
    }
}
