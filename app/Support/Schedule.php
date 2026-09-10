<?php

namespace App\Support;

use App\Models\Registration;

/**
 * زمان‌بندی کلاس‌ها — تنها منبع اطلاعات اساتید و بازه‌های ۳۰ دقیقه‌ای.
 *
 * هر استاد یک روز ثابت در هفته دارد و کلاس‌هایش از ساعت شروع تا ساعت پایان
 * پیکربندی‌شده در config/school.php به بازه‌های نیم‌ساعته تقسیم می‌شود.
 */
class Schedule
{
    /**
     * فهرست بازه‌های زمانی به صورت 'HH:MM' — مثلاً ۱۰:۰۰ تا ۱۹:۳۰.
     *
     * @return list<string>
     */
    public static function slots(): array
    {
        $config = config('school.slots');

        $start = self::toMinutes($config['start']);
        $end = self::toMinutes($config['end']);
        $step = (int) $config['minutes'];

        $slots = [];

        // آخرین کلاس باید پیش از ساعت پایان تمام شود.
        for ($minute = $start; $minute + $step <= $end; $minute += $step) {
            $slots[] = self::toClock($minute);
        }

        return $slots;
    }

    /**
     * گروه‌های آموزشی به همان ترتیبی که در صفحهٔ اصلی نمایش داده می‌شوند.
     *
     * @return list<array<string, mixed>>
     */
    public static function groups(): array
    {
        return config('school.groups', []);
    }

    /**
     * همهٔ اساتید به صورت تخت، کلید هر کدام شناسهٔ یکتای اوست.
     *
     * @return array<string, array<string, string>>
     */
    public static function teachers(): array
    {
        $teachers = [];

        foreach (self::groups() as $group) {
            foreach ($group['teachers'] as $teacher) {
                $teachers[$teacher['slug']] = $teacher + [
                    'instrument' => $group['instrument'],
                    'icon' => $group['icon'],
                ];
            }
        }

        return $teachers;
    }

    /**
     * @return array<string, string>|null
     */
    public static function teacher(string $slug): ?array
    {
        return self::teachers()[$slug] ?? null;
    }

    /**
     * بازه‌های رزروشده به تفکیک استاد: ['piano-saremi' => ['10:30', '11:00']].
     *
     * @return array<string, list<string>>
     */
    public static function bookedSlots(): array
    {
        return Registration::query()
            ->get(['teacher_slug', 'slot'])
            ->groupBy('teacher_slug')
            ->map(fn ($rows) => $rows->pluck('slot')->all())
            ->all();
    }

    public static function isValidSlot(string $slot): bool
    {
        return in_array($slot, self::slots(), true);
    }

    /**
     * تبدیل ارقام فارسی و عربی به لاتین تا مقایسه و ذخیره‌سازی یکدست بماند.
     */
    public static function digits(?string $value): string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $latin = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabic, $latin, str_replace($persian, $latin, (string) $value));
    }

    /**
     * نمایش ساعت با ارقام فارسی — مثلاً "۱۰:۳۰".
     */
    public static function toPersianDigits(string $value): string
    {
        return str_replace(
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
            $value
        );
    }

    private static function toMinutes(string $clock): int
    {
        [$hour, $minute] = array_map('intval', explode(':', $clock));

        return ($hour * 60) + $minute;
    }

    private static function toClock(int $minutes): string
    {
        return sprintf('%02d:%02d', intdiv($minutes, 60), $minutes % 60);
    }
}
