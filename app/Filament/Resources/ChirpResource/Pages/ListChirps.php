<?php

namespace App\Filament\Resources\ChirpResource\Pages;

use App\Filament\Resources\ChirpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChirps extends ListRecords
{
    protected static string $resource = ChirpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
