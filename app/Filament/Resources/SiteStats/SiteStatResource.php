<?php

namespace App\Filament\Resources\SiteStats;

use App\Filament\Resources\SiteStats\Pages\CreateSiteStat;
use App\Filament\Resources\SiteStats\Pages\EditSiteStat;
use App\Filament\Resources\SiteStats\Pages\ListSiteStats;
use App\Filament\Resources\SiteStats\Schemas\SiteStatForm;
use App\Filament\Resources\SiteStats\Tables\SiteStatsTable;
use App\Models\SiteStat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SiteStatResource extends Resource
{
    protected static ?string $model = SiteStat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'آمار صفحهٔ اصلی';

    protected static ?string $modelLabel = 'کارت آمار';

    protected static ?string $pluralModelLabel = 'آمار صفحهٔ اصلی';

    protected static ?string $recordTitleAttribute = 'value';

    public static function form(Schema $schema): Schema
    {
        return SiteStatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteStatsTable::configure($table);
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
            'index' => ListSiteStats::route('/'),
            'create' => CreateSiteStat::route('/create'),
            'edit' => EditSiteStat::route('/{record}/edit'),
        ];
    }
}
