<?php

namespace App\Filament\Resources\BukuKaruResource\Pages;

use App\Filament\Resources\BukuKaruResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBukuKarus extends ListRecords
{
    protected static string $resource = BukuKaruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
