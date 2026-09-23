<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Teacher extends Model
{
    protected $fillable = [
        'instrument',
        'icon',
        'slug',
        'name',
        'photo',
        'headline',
        'bio',
        'footer_image',
        'day',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        // با حذف استاد، عکس‌های او هم از دیسک پاک می‌شوند.
        static::deleting(function (Teacher $teacher) {
            foreach ([$teacher->photo, $teacher->footer_image] as $file) {
                if ($file) {
                    Storage::disk('public')->delete($file);
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نشانی کامل عکس استاد یا null اگر عکسی نداشته باشد.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::disk('public')->url($this->photo) : null;
    }

    /**
     * نشانی کامل عکس انتهای صفحهٔ بیوگرافی یا null.
     */
    public function getFooterImageUrlAttribute(): ?string
    {
        return $this->footer_image ? Storage::disk('public')->url($this->footer_image) : null;
    }

    /**
     * برچسب روز کلاس — مثلاً «دوشنبه» ⟵ «دوشنبه‌ها» (با نیم‌فاصله).
     */
    public function getDayLabelAttribute(): string
    {
        return $this->day ? $this->day."\u{200C}ها" : '';
    }
}
