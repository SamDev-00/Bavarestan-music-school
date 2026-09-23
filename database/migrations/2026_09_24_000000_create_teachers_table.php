<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            // نام گروه/ساز که استاد زیر آن نمایش داده می‌شود — مثلاً «پیانو».
            $table->string('instrument');
            // آیکون گروه (اموجی یا نماد) — مثلاً «♪».
            $table->string('icon')->default('♪');

            // شناسهٔ یکتای انگلیسی استاد — در فرم ثبت‌نام و رزروها استفاده می‌شود.
            $table->string('slug')->unique();
            $table->string('name');

            // روز ثابت کلاس در هفته — مثلاً «دوشنبه». برچسب («دوشنبه‌ها») خودکار ساخته می‌شود.
            $table->string('day');

            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });

        // انتقال اساتید فعلی از config/school.php تا چیزی از دست نرود.
        $order = 0;

        foreach (config('school.groups', []) as $group) {
            foreach ($group['teachers'] as $teacher) {
                $order += 10;

                DB::table('teachers')->insert([
                    'instrument' => $group['instrument'],
                    'icon' => $group['icon'],
                    'slug' => $teacher['slug'],
                    'name' => $teacher['name'],
                    'day' => $teacher['day'],
                    'sort_order' => $order,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
