<?php

namespace App\Filament\Resources\SelfAssesmentResource\Pages;

use App\Filament\Resources\SelfAssesmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSelfAssesment extends EditRecord
{
    protected static string $resource = SelfAssesmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
