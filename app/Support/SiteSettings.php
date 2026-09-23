<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSettings
{
    /**
     * همهٔ تنظیمات به صورت [key => value] (کش‌شده تا اولین تغییر).
     *
     * @return array<string, string|null>
     */
    public static function all(): array
    {
        if (! Schema::hasTable('site_settings')) {
            return [];
        }

        return Cache::rememberForever(
            'site_settings',
            fn () => SiteSetting::query()->pluck('value', 'key')->all()
        );
    }

    /**
     * مقدار یک تنظیم؛ اگر خالی یا موجود نبود، مقدار پیش‌فرض برگردانده می‌شود.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $value = static::all()[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }

    public static function forget(): void
    {
        Cache::forget('site_settings');
    }
}
