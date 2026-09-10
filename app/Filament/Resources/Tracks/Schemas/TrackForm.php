<?php

namespace App\Filament\Resources\Tracks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TrackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('نام قطعه')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('artist')
                    ->label('اجرا از (اختیاری)')
                    ->maxLength(255)
                    ->placeholder('مثلاً امین اکبرپور — تار'),

                TextInput::make('sort_order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0),

                Textarea::make('description')
                    ->label('توضیح کوتاه (اختیاری)')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull(),

                FileUpload::make('file')
                    ->label('فایل صوتی')
                    ->disk('public')
                    ->directory('music')
                    ->visibility('public')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp4', 'audio/wav', 'audio/ogg', 'audio/x-m4a'])
                    ->maxSize(20480) // ۲۰ مگابایت
                    ->required()
                    ->downloadable()
                    ->helperText('فرمت MP3، M4A، WAV یا OGG — حداکثر ۲۰ مگابایت.')
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('نمایش در سایت')
                    ->default(true)
                    ->helperText('اگر خاموش باشد، قطعه در بخش «موسیقی» صفحهٔ اصلی دیده نمی‌شود.'),
            ]);
    }
}
