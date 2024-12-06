<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;

use App\Models\Country;
use Filament\Forms;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

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

                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('image')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('banner')
                    ->sortable()
                    ->searchable(),

//                Tables\Columns\TextColumn::make('timezones.name')
//                    ->sortable()
//                    ->searchable(),
                Tables\Columns\TextColumn::make('timezones_count')->counts('timezones'),


                ToggleColumn::make('feature')
                    ->sortable()
                    ->onIcon('heroicon-m-user')
                    ->offIcon('heroicon-m-user')
                    ->onColor('success')
                    ->offColor('danger')
                    ->getStateUsing(fn ($record) => $record->feature === 'yes')  // Interpret "yes" as true
                    ->updateStateUsing(fn ($record, $state) => $state ? 'yes' : 'no')
                    ->afterStateUpdated(function ($state, $record) {
                        // Set the feature column to "yes" or "no" based on the toggle state
                        $record->feature = $state ? 'yes' : 'no';
                        // Save the record to the database
                        $record->save();
                    }),

//                Tables\Columns\TextColumn::make('created_at')
//                    ->dateTime(),



            ])
            ->filters([
                //


                    Filter::make('Feature')
                        ->query(fn (Builder $query) => $query->where('feature', 'yes')),
                    Filter::make('Not Feature')
                        ->query(fn (Builder $query) => $query->where('feature', 'no')),
                Filter::make('No City ')
                        ->query(fn (Builder $query) => $query->doesntHave('cities')),
  Filter::make('No Time Zone ')
                        ->query(fn (Builder $query) => $query->doesntHave('timezones')),


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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
