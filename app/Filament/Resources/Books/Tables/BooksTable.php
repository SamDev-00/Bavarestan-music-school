<?php

namespace App\Filament\Resources\Books\Tables;

use App\Models\Book;
use App\Support\Jalali;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('author')
                    ->label('نویسنده')
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
                Action::make('download')
                    ->label('دانلود')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Book $record) => route('books.download', $record))
                    ->openUrlInNewTab()
                    ->visible(fn (Book $record) => filled($record->file)),
                EditAction::make(),
                DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('حذف کتاب')
                    ->modalDescription('کتاب و فایل PDF آن برای همیشه پاک می‌شود. این کار قابل بازگشت نیست.')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هنوز کتابی بارگذاری نشده است');
    }
}
