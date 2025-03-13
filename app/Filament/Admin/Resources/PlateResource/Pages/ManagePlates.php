<?php

namespace App\Filament\Admin\Resources\PlateResource\Pages;

use App\Filament\Admin\Resources\PlateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePlates extends ManageRecords
{
    protected static string $resource = PlateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
