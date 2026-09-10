<?php

namespace App\Filament\Resources\Registrations\Tables;

use App\Support\Jalali;
use App\Support\Schedule;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام هنرجو')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('national_id')
                    ->label('شماره ملی')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('phone')
                    ->label('شماره تماس')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('teacher_name')
                    ->label('استاد')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('instrument')
                    ->label('گروه')
                    ->toggleable(),
                TextColumn::make('day')
                    ->label('روز')
                    ->sortable(),
                TextColumn::make('slot')
                    ->label('ساعت')
                    ->formatStateUsing(fn (string $state) => Schedule::toPersianDigits($state))
                    ->sortable(),
                TextColumn::make('level')
                    ->label('سطح')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('mode')
                    ->label('نوع کلاس')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('education')
                    ->label('تحصیلات')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('referral_source')
                    ->label('نحوهٔ آشنایی')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('referrer')
                    ->label('معرف')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('تاریخ ثبت‌نام')
                    ->formatStateUsing(fn ($state) => Jalali::dateTime($state))
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('teacher_slug')
                    ->label('استاد')
                    ->options(fn () => collect(Schedule::teachers())
                        ->mapWithKeys(fn ($teacher, $slug) => [$slug => $teacher['name'].' — '.$teacher['instrument']])
                        ->all()),
                SelectFilter::make('day')
                    ->label('روز')
                    ->options(fn () => collect(Schedule::teachers())
                        ->pluck('day', 'day')
                        ->all()),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('حذف ثبت‌نام')
                    ->modalDescription('با حذف این ثبت‌نام، ساعت کلاس دوباره برای رزرو آزاد می‌شود.')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هنوز ثبت‌نامی انجام نشده است');
    }
}
