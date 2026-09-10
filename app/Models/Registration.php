<?php

namespace App\Models;

use App\Support\Schedule;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'teacher_slug',
        'teacher_name',
        'instrument',
        'day',
        'slot',
        'national_id',
        'name',
        'phone',
        'education',
        'level',
        'mode',
        'referral_source',
        'referrer',
        'message',
    ];

    /**
     * "دوشنبه ۱۴:۳۰" — برای نمایش در پنل ادمین و کارت لغو رزرو.
     */
    public function getScheduleLabelAttribute(): string
    {
        return $this->day.' — '.Schedule::toPersianDigits($this->slot);
    }

    /**
     * رزروهای یک هنرجو بر اساس کد ملی و شمارهٔ تماس.
     */
    public function scopeOwnedBy($query, string $nationalId, string $phone)
    {
        return $query->where('national_id', Schedule::digits($nationalId))
            ->where('phone', Schedule::digits($phone));
    }
}
