<?php

namespace App\Filament\Resources\ServiceRequests\Pages;

use App\Filament\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Resources\Pages\ListRecords;

class ListServiceRequests extends ListRecords
{
    protected static string $resource = ServiceRequestResource::class;

    // درخواست‌ها از فرم سایت ثبت می‌شوند؛ ساختن دستی لازم نیست.
    protected function getHeaderActions(): array
    {
        return [];
    }
}
