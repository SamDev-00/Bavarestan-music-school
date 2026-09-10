<?php

namespace App\Filament\Resources\SiteStats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteStatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('value')
                    ->label('خط اول (درشت)')
                    ->required()
                    ->maxLength(60)
                    ->placeholder('۸ گروه')
                    ->helperText('همان چیزی که درشت و بنفش دیده می‌شود. عدد را با ارقام فارسی بنویسید.')
                    ->columnSpanFull(),

                TextInput::make('caption')
                    ->label('خط دوم (توضیح)')
                    ->required()
                    ->maxLength(80)
                    ->placeholder('ساز و رشته آموزشی')
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_visible')
                    ->label('نمایش در سایت')
                    ->default(true),
            ]);
    }
}
