<?php

namespace App\Filament\Resources\ProfilPerawatResource\Pages;

use App\Filament\Resources\ProfilPerawatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilPerawats extends ListRecords
{
    protected static string $resource = ProfilPerawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
