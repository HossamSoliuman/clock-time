<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbbreviationLongNameResource\Pages;
use App\Filament\Resources\AbbreviationLongNameResource\RelationManagers;
use App\Models\AbbreviationLongName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbbreviationLongNameResource extends Resource
{
    protected static ?string $model = AbbreviationLongName::class;

    protected static ?string $label = 'TZ Name';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('abbreviation.name')
                                ->sortable()
                                ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAbbreviationLongNames::route('/'),
            'create' => Pages\CreateAbbreviationLongName::route('/create'),
            'edit' => Pages\EditAbbreviationLongName::route('/{record}/edit'),
        ];
    }
}
