<?php

namespace App\Filament\Resources\SiteStats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class SiteStatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // هر دو خط مستقیم از همین جدول قابل ویرایش‌اند.
                TextInputColumn::make('value')
                    ->label('خط اول (درشت)')
                    ->rules(['required', 'max:60']),
                TextInputColumn::make('caption')
                    ->label('خط دوم (توضیح)')
                    ->rules(['required', 'max:80']),
                IconColumn::make('is_visible')
                    ->label('نمایش در سایت')
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
                    ->modalHeading('حذف کارت آمار')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هیچ کارتی ثبت نشده است');
    }
}
