<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $get, $set) {
                        if (blank($get('slug'))) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('نامک (اختیاری)')
                    ->helperText('اگر خالی بماند، به‌صورت خودکار از عنوان ساخته می‌شود.')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('excerpt')
                    ->label('خلاصه')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('متن مطلب')
                    ->columnSpanFull(),

                FileUpload::make('cover_image')
                    ->label('تصویر شاخص')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('posts')
                    ->visibility('public')
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('منتشر شود')
                    ->default(false),

                DateTimePicker::make('published_at')
                    ->label('تاریخ انتشار')
                    ->helperText('خالی بگذارید تا بلافاصله منتشر شود.'),
            ]);
    }
}
