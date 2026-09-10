<?php

namespace App\Models;

use App\Support\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'file',
        'file_size',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'file_size' => 'integer',
    ];

    protected static function booted(): void
    {
        // اندازهٔ فایل هنگام بارگذاری ثبت می‌شود تا در سایت نمایش داده شود.
        static::saving(function (Book $book) {
            if ($book->isDirty('file') && $book->file && Storage::disk('public')->exists($book->file)) {
                $book->file_size = Storage::disk('public')->size($book->file);
            }
        });

        // جایگزینی فایل: نسخهٔ قبلی از دیسک پاک شود تا فضا هدر نرود.
        static::updating(function (Book $book) {
            if ($book->isDirty('file')) {
                $previous = $book->getOriginal('file');

                if ($previous) {
                    Storage::disk('public')->delete($previous);
                }
            }
        });

        static::deleting(function (Book $book) {
            if ($book->file) {
                Storage::disk('public')->delete($book->file);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * اندازهٔ فایل با ارقام فارسی — مثلاً «۲.۴ مگابایت».
     */
    public function getFileSizeLabelAttribute(): ?string
    {
        if (! $this->file_size) {
            return null;
        }

        $megabytes = $this->file_size / 1048576;

        $label = $megabytes >= 1
            ? number_format($megabytes, 1).' مگابایت'
            : max(1, (int) round($this->file_size / 1024)).' کیلوبایت';

        return Schedule::toPersianDigits($label);
    }

    /**
     * نام فایل هنگام دانلود — بر اساس عنوان کتاب.
     */
    public function getDownloadNameAttribute(): string
    {
        return trim($this->title).'.pdf';
    }
}
