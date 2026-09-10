<?php

namespace App\Filament\Resources\ServiceRequests\Tables;

use App\Models\ServiceRequest;
use App\Support\Jalali;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ServiceRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->formatStateUsing(fn ($state) => Jalali::dateTime($state))
                    ->sortable(),
                TextColumn::make('name')
                    ->label('نام مشتری')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('شماره تماس')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('instrument')
                    ->label('ساز')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('service_type')
                    ->label('نوع خدمات'),

                // وضعیت مستقیم از همین جدول قابل تغییر است.
                SelectColumn::make('status')
                    ->label('وضعیت')
                    ->options(ServiceRequest::STATUSES)
                    ->selectablePlaceholder(false)
                    ->rules(['required']),

                TextColumn::make('description')
                    ->label('توضیح مشتری')
                    ->limit(40)
                    ->tooltip(fn (?ServiceRequest $record) => $record?->description)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('admin_note')
                    ->label('یادداشت داخلی')
                    ->limit(40)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options(ServiceRequest::STATUSES),
                SelectFilter::make('instrument')
                    ->label('ساز')
                    ->options(ServiceRequest::options(ServiceRequest::INSTRUMENTS)),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->label('حذف')
                    ->modalHeading('حذف درخواست تعمیر')
                    ->modalSubmitActionLabel('بله، حذف کن'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب‌شده‌ها'),
                ]),
            ])
            ->emptyStateHeading('هنوز درخواستی ثبت نشده است');
    }
}
