<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GmtResource\Pages;
use App\Filament\Resources\GmtResource\RelationManagers;
use App\Models\Gmt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GmtResource extends Resource
{
    protected static ?string $model = Gmt::class;

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

                Tables\Columns\TextColumn::make('utc_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('utc_slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('dst')
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
            'index' => Pages\ListGmts::route('/'),
            'create' => Pages\CreateGmt::route('/create'),
            'edit' => Pages\EditGmt::route('/{record}/edit'),
        ];
    }
}
