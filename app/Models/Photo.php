<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'image',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Photo $photo) {
            if ($photo->image) {
                Storage::disk('public')->delete($photo->image);
            }
        });
    }
}
