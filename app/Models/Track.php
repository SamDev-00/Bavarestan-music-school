<?php

namespace App\Models;

use App\Support\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Track extends Model
{
    protected $fillable = [
        'title',
        'artist',
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
        static::saving(function (Track $track) {
            if ($track->isDirty('file') && $track->file && Storage::disk('public')->exists($track->file)) {
                $track->file_size = Storage::disk('public')->size($track->file);
            }
        });

        // جایگزینی فایل: نسخهٔ قبلی پاک شود تا فضای هاست هدر نرود.
        static::updating(function (Track $track) {
            if ($track->isDirty('file')) {
                $previous = $track->getOriginal('file');

                if ($previous) {
                    Storage::disk('public')->delete($previous);
                }
            }
        });

        static::deleting(function (Track $track) {
            if ($track->file) {
                Storage::disk('public')->delete($track->file);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

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
}
