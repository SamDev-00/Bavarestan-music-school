<?php

namespace App\Filament\Resources\ServiceRequests\Schemas;

use App\Models\ServiceRequest;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('پیگیری')
                    ->description('وضعیت و یادداشت داخلی — برای مشتری نمایش داده نمی‌شود.')
                    ->schema([
                        Select::make('status')
                            ->label('وضعیت')
                            ->options(ServiceRequest::STATUSES)
                            ->default('new')
                            ->required()
                            ->native(false),

                        Textarea::make('admin_note')
                            ->label('یادداشت داخلی')
                            ->rows(3)
                            ->placeholder('مثلاً: هزینه ۴۵۰ هزار تومان اعلام شد، مشتری تأیید کرد.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('اطلاعات درخواست')
                    ->schema([
                        TextInput::make('name')
                            ->label('نام و نام خانوادگی')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('phone')
                            ->label('شماره تماس')
                            ->required()
                            ->maxLength(20),

                        Select::make('instrument')
                            ->label('ساز')
                            ->options(ServiceRequest::options(ServiceRequest::INSTRUMENTS))
                            ->required()
                            ->native(false),

                        Select::make('service_type')
                            ->label('نوع خدمات')
                            ->options(ServiceRequest::options(ServiceRequest::SERVICE_TYPES))
                            ->required()
                            ->native(false),

                        Textarea::make('description')
                            ->label('توضیح مشتری')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
