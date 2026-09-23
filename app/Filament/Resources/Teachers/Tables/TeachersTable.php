<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('عکس')
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl(asset('images/brand-icon.png')),
                TextColumn::make('name')
                    ->label('نام استاد')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('instrument')
                    ->label('گروه / ساز')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('icon')
                    ->label('آیکون'),
                TextColumn::make('day')
                    ->label('روز کلاس'),
                TextColumn::make('slug')
                    ->label('شناسه')
                    ->color('gray')
                    ->copyable(),
                IconColumn::make('is_active')
                    ->label('فعال')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('ترتیب')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('حذف استاد')
                    ->modalDescription('با حذف استاد، دیگر در سایت و فرم ثبت‌نام نمایش داده نمی‌شود. رزروهای قبلی هنرجویان حذف نمی‌شوند.')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هنوز استادی ثبت نشده است');
    }
}
