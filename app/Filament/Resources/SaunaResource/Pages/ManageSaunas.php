<?php

namespace App\Filament\Resources\SaunaResource\Pages;

use App\Filament\Resources\SaunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSaunas extends ManageRecords
{
    protected static string $resource = SaunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
