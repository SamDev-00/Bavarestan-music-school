<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBook extends EditRecord
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('حذف کتاب')
                ->modalHeading('حذف کتاب')
                ->modalDescription('کتاب و فایل PDF آن برای همیشه پاک می‌شود. این کار قابل بازگشت نیست.')
                ->modalSubmitActionLabel('بله، حذف کن'),
        ];
    }
}
