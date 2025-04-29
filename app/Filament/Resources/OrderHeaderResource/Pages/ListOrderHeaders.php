<?php

namespace App\Filament\Resources\OrderHeaderResource\Pages;

use App\Filament\Resources\OrderHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderHeaders extends ListRecords
{
    protected static string $resource = OrderHeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
