<?php

namespace App\Filament\Resources\SaleBooks\Pages;

use App\Filament\Resources\SaleBooks\SaleBookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSaleBook extends EditRecord
{
    protected static string $resource = SaleBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('حذف کتاب')
                ->modalHeading('حذف کتاب از فهرست فروش')
                ->modalSubmitActionLabel('بله، حذف کن'),
        ];
    }
}
