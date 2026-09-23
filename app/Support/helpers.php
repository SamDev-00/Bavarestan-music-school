<?php

use App\Support\SiteSettings;

if (! function_exists('site_setting')) {
    /**
     * خواندن یک تنظیم سایت (تماس، موقعیت و ...) از مقادیر کش‌شده.
     */
    function site_setting(string $key, ?string $default = null): ?string
    {
        return SiteSettings::get($key, $default);
    }
}

if (! function_exists('tel_href')) {
    /**
     * ساخت لینک «tel:» از یک شمارهٔ فارسی یا انگلیسی.
     * ارقام فارسی/عربی به انگلیسی تبدیل و فاصله‌ها حذف می‌شوند.
     */
    function tel_href(?string $phone): string
    {
        if ($phone === null || trim($phone) === '') {
            return '';
        }

        $map = [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ];

        $latin = strtr($phone, $map);
        $plus = str_starts_with(trim($latin), '+') ? '+' : '';
        $digits = preg_replace('/\D+/', '', $latin);

        return 'tel:'.$plus.$digits;
    }
}
