<?php

namespace App\Filament\Resources\ChirpResource\Pages;

use App\Filament\Resources\ChirpResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChirp extends ViewRecord
{
    protected static string $resource = ChirpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
