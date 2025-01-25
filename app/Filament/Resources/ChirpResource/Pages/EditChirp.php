<?php

namespace App\Filament\Resources\ChirpResource\Pages;

use App\Filament\Resources\ChirpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChirp extends EditRecord
{
    protected static string $resource = ChirpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
