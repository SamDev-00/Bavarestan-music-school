<?php

namespace App\Support;

use DateTimeInterface;
use DateTimeZone;

/**
 * تبدیل تاریخ میلادی به شمسی (هجری خورشیدی).
 *
 * بدون وابستگی به پکیج بیرونی یا افزونهٔ intl نوشته شده تا روی هاست اشتراکی
 * هم بدون نصب چیزی کار کند. تاریخ‌ها در دیتابیس به وقت UTC ذخیره می‌مانند و
 * فقط هنگام نمایش به وقت تهران تبدیل می‌شوند.
 */
class Jalali
{
    public const TIMEZONE = 'Asia/Tehran';

    public const MONTHS = [
        1 => 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور',
        'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند',
    ];

    /**
     * @return array{0:int,1:int,2:int} [سال، ماه، روز]
     */
    public static function toJalali(int $gy, int $gm, int $gd): array
    {
        $daysToMonth = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];

        $gy2 = $gm > 2 ? $gy + 1 : $gy;

        $days = 355666
            + (365 * $gy)
            + intdiv($gy2 + 3, 4)
            - intdiv($gy2 + 99, 100)
            + intdiv($gy2 + 399, 400)
            + $gd
            + $daysToMonth[$gm - 1];

        $jy = -1595 + (33 * intdiv($days, 12053));
        $days %= 12053;

        $jy += 4 * intdiv($days, 1461);
        $days %= 1461;

        if ($days > 365) {
            $jy += intdiv($days - 1, 365);
            $days = ($days - 1) % 365;
        }

        if ($days < 186) {
            $jm = 1 + intdiv($days, 31);
            $jd = 1 + ($days % 31);
        } else {
            $jm = 7 + intdiv($days - 186, 30);
            $jd = 1 + (($days - 186) % 30);
        }

        return [$jy, $jm, $jd];
    }

    /**
     * «۱۹ شهریور ۱۴۰۵»
     */
    public static function date(DateTimeInterface|string|null $date): string
    {
        if (! $moment = self::normalize($date)) {
            return '—';
        }

        [$jy, $jm, $jd] = self::toJalali(
            (int) $moment->format('Y'),
            (int) $moment->format('n'),
            (int) $moment->format('j'),
        );

        return Schedule::toPersianDigits($jd.' '.self::MONTHS[$jm].' '.$jy);
    }

    /**
     * «۱۴۰۵/۰۶/۱۹»
     */
    public static function numeric(DateTimeInterface|string|null $date): string
    {
        if (! $moment = self::normalize($date)) {
            return '—';
        }

        [$jy, $jm, $jd] = self::toJalali(
            (int) $moment->format('Y'),
            (int) $moment->format('n'),
            (int) $moment->format('j'),
        );

        return Schedule::toPersianDigits(sprintf('%04d/%02d/%02d', $jy, $jm, $jd));
    }

    /**
     * «۱۹ شهریور ۱۴۰۵ — ۱۴:۳۰»
     */
    public static function dateTime(DateTimeInterface|string|null $date): string
    {
        if (! $moment = self::normalize($date)) {
            return '—';
        }

        return self::date($moment).' — '.Schedule::toPersianDigits($moment->format('H:i'));
    }

    /**
     * تبدیل ورودی به شیء تاریخ در منطقهٔ زمانی تهران.
     */
    private static function normalize(DateTimeInterface|string|null $date): ?DateTimeInterface
    {
        if (blank($date)) {
            return null;
        }

        if (is_string($date)) {
            try {
                $date = new \DateTimeImmutable($date);
            } catch (\Exception) {
                return null;
            }
        }

        return \DateTimeImmutable::createFromInterface($date)
            ->setTimezone(new DateTimeZone(self::TIMEZONE));
    }
}
