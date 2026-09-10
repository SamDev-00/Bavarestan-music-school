<?php

namespace App\Filament\Resources\SaleBooks\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SaleBookForm
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

                TextInput::make('price')
                    ->label('قیمت (تومان)')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->step(1000)
                    ->suffix('تومان')
                    ->helperText('عدد را بدون جداکننده وارد کنید — مثلاً ۲۵۰۰۰۰. عدد صفر یعنی «تماس بگیرید».'),

                Textarea::make('description')
                    ->label('توضیح کوتاه (اختیاری)')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_available')
                    ->label('موجود و قابل نمایش')
                    ->default(true)
                    ->helperText('اگر خاموش باشد، کتاب در بخش «تهیه کتب آموزشی» دیده نمی‌شود.'),
            ]);
    }
}
