<?php

namespace App\Filament\Resources\BarResource\Pages;

use App\Filament\Resources\BarResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBars extends ManageRecords
{
    protected static string $resource = BarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
