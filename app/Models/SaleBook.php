<?php

namespace App\Models;

use App\Support\Schedule;
use Illuminate\Database\Eloquent\Model;

class SaleBook extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'is_available',
        'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'integer',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * قیمت با جداکنندهٔ هزارگان و ارقام فارسی — مثلاً «۲۵۰٬۰۰۰ تومان».
     */
    public function getPriceLabelAttribute(): string
    {
        if ($this->price <= 0) {
            return 'تماس بگیرید';
        }

        return Schedule::toPersianDigits(number_format($this->price, 0, '.', '٬')).' تومان';
    }
}
