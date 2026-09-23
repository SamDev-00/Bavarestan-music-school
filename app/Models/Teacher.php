<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'instrument',
        'icon',
        'slug',
        'name',
        'day',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * برچسب روز کلاس — مثلاً «دوشنبه» ⟵ «دوشنبه‌ها» (با نیم‌فاصله).
     */
    public function getDayLabelAttribute(): string
    {
        return $this->day ? $this->day."\u{200C}ها" : '';
    }
}
