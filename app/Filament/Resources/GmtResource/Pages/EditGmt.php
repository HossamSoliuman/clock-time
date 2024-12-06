<?php

namespace App\Filament\Resources\GmtResource\Pages;

use App\Filament\Resources\GmtResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGmt extends EditRecord
{
    protected static string $resource = GmtResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
