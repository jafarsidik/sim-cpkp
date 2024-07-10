<?php

namespace App\Filament\Resources\SelfAssesmentResource\Pages;

use App\Filament\Resources\SelfAssesmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSelfAssesments extends ListRecords
{
    protected static string $resource = SelfAssesmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
