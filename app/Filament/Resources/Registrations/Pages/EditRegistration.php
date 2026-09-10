<?php

namespace App\Filament\Resources\Registrations\Pages;

use App\Filament\Resources\Registrations\RegistrationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegistration extends EditRecord
{
    protected static string $resource = RegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('حذف ثبت‌نام')
                ->modalHeading('حذف ثبت‌نام')
                ->modalDescription('با حذف این ثبت‌نام، ساعت کلاس دوباره برای رزرو آزاد می‌شود.')
                ->modalSubmitActionLabel('بله، حذف کن'),
        ];
    }
}
