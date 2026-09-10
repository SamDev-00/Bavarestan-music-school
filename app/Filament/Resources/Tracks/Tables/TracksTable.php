<?php

namespace App\Filament\Resources\Tracks\Tables;

use App\Models\Track;
use App\Support\Jalali;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TracksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('نام قطعه')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('artist')
                    ->label('اجرا از')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('file_size_label')
                    ->label('حجم فایل')
                    ->placeholder('—'),
                IconColumn::make('is_published')
                    ->label('نمایش در سایت')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('ترتیب')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('تاریخ بارگذاری')
                    ->formatStateUsing(fn ($state) => Jalali::dateTime($state))
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('listen')
                    ->label('پخش')
                    ->icon('heroicon-o-play')
                    ->url(fn (Track $record) => route('music.stream', $record))
                    ->openUrlInNewTab()
                    ->visible(fn (Track $record) => filled($record->file)),
                EditAction::make(),
                DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('حذف قطعه')
                    ->modalDescription('قطعه و فایل صوتی آن برای همیشه پاک می‌شود.')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هنوز قطعه‌ای بارگذاری نشده است');
    }
}
