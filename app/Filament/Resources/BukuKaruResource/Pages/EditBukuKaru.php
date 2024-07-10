<?php

namespace App\Filament\Resources\BukuKaruResource\Pages;

use App\Filament\Resources\BukuKaruResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBukuKaru extends EditRecord
{
    protected static string $resource = BukuKaruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
