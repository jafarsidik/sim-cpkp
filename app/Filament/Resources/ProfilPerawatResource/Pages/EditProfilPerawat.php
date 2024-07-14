<?php

namespace App\Filament\Resources\ProfilPerawatResource\Pages;

use App\Filament\Resources\ProfilPerawatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilPerawat extends EditRecord
{
    protected static string $resource = ProfilPerawatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['user_id'] = auth()->id();

    //     return $data;
    // }
}
