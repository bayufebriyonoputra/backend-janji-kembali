<?php

namespace App\Filament\Resources\OrderHeaderResource\Pages;

use App\Filament\Resources\OrderHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderHeader extends EditRecord
{
    protected static string $resource = OrderHeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
