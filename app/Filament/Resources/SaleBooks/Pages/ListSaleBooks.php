<?php

namespace App\Filament\Resources\SaleBooks\Pages;

use App\Filament\Resources\SaleBooks\SaleBookResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSaleBooks extends ListRecords
{
    protected static string $resource = SaleBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('افزودن کتاب برای فروش'),
        ];
    }
}
