<?php

namespace App\Filament\Resources\PenilaianKinerjaResource\Pages;

use App\Filament\Resources\PenilaianKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianKinerja extends EditRecord
{
    protected static string $resource = PenilaianKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
