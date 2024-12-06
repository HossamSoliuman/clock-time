<?php

namespace App\Filament\Resources\AbbreviationLongNameResource\Pages;

use App\Filament\Resources\AbbreviationLongNameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbbreviationLongName extends EditRecord
{
    protected static string $resource = AbbreviationLongNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
