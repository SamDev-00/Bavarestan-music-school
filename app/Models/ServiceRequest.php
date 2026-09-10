<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    /** وضعیت‌های پیگیری، به ترتیب مراحل کار. */
    public const STATUSES = [
        'new' => 'ثبت شده',
        'in_progress' => 'در حال انجام',
        'ready' => 'آماده تحویل',
        'done' => 'تحویل شد',
        'cancelled' => 'لغو شد',
    ];

    /** سازهایی که برای آن‌ها خدمات ارائه می‌شود. */
    public const INSTRUMENTS = [
        'پیانو', 'گیتار', 'گیتار الکتریک', 'ویلن', 'تار', 'سه‌تار', 'سنتور', 'تنبک', 'سایر',
    ];

    /** نوع خدمات قابل درخواست. */
    public const SERVICE_TYPES = [
        'تعمیر', 'کوک', 'تعویض سیم', 'سرویس و نگهداری', 'مشاوره خرید', 'سایر',
    ];

    protected $fillable = [
        'name',
        'phone',
        'instrument',
        'service_type',
        'description',
        'status',
        'admin_note',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /**
     * رنگ نشان وضعیت در جدول پنل ادمین.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'new' => 'warning',
            'in_progress' => 'info',
            'ready' => 'primary',
            'done' => 'success',
            'cancelled' => 'danger',
            default => 'gray',
        };
    }

    public function scopeOpen($query)
    {
        return $query->whereNotIn('status', ['done', 'cancelled']);
    }

    /**
     * @return array<string, string>
     */
    public static function options(array $values): array
    {
        return array_combine($values, $values);
    }
}
