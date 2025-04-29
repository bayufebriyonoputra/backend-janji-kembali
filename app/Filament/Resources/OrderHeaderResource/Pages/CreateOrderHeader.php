<?php

namespace App\Filament\Resources\OrderHeaderResource\Pages;

use App\Filament\Resources\OrderHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderHeader extends CreateRecord
{
    protected static string $resource = OrderHeaderResource::class;
}
