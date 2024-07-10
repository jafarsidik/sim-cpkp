<?php

namespace App\Filament\Resources\ProfilPerawatResource\Pages;

use App\Filament\Resources\ProfilPerawatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfilPerawat extends CreateRecord
{
    protected static string $resource = ProfilPerawatResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
