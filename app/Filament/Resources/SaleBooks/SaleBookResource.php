<?php

namespace App\Filament\Resources\SaleBooks;

use App\Filament\Resources\SaleBooks\Pages\CreateSaleBook;
use App\Filament\Resources\SaleBooks\Pages\EditSaleBook;
use App\Filament\Resources\SaleBooks\Pages\ListSaleBooks;
use App\Filament\Resources\SaleBooks\Schemas\SaleBookForm;
use App\Filament\Resources\SaleBooks\Tables\SaleBooksTable;
use App\Models\SaleBook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SaleBookResource extends Resource
{
    protected static ?string $model = SaleBook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $navigationLabel = 'تهیه کتب آموزشی';

    protected static ?string $modelLabel = 'کتاب فروشی';

    protected static ?string $pluralModelLabel = 'تهیه کتب آموزشی';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SaleBookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SaleBooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSaleBooks::route('/'),
            'create' => CreateSaleBook::route('/create'),
            'edit' => EditSaleBook::route('/{record}/edit'),
        ];
    }
}
