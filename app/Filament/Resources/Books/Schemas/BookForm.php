<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان کتاب')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('author')
                    ->label('نویسنده (اختیاری)')
                    ->maxLength(255),

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
                    ->label('فایل PDF')
                    ->disk('public')
                    ->directory('books')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(30720) // ۳۰ مگابایت
                    ->required()
                    ->downloadable()
                    ->helperText('فقط فایل PDF، حداکثر ۳۰ مگابایت.')
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('نمایش در سایت')
                    ->default(true)
                    ->helperText('اگر خاموش باشد، کتاب در صفحهٔ «کتب آموزشی» دیده نمی‌شود.'),
            ]);
    }
}
