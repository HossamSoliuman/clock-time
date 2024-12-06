<?php

namespace App\Filament\Resources\AbbreviationLongNameResource\Pages;

use App\Filament\Resources\AbbreviationLongNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbbreviationLongNames extends ListRecords
{
    protected static string $resource = AbbreviationLongNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
