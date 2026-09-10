<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_stats', function (Blueprint $table) {
            $table->id();
            $table->string('value');   // خط درشت — مثلاً «۸ گروه»
            $table->string('caption'); // خط توضیح زیر آن
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_visible', 'sort_order']);
        });

        // همان چهار کارتی که تا امروز در کد ثابت بودند، تا ظاهر سایت عوض نشود.
        $now = now();

        DB::table('site_stats')->insert([
            ['value' => '۸ گروه', 'caption' => 'ساز و رشته آموزشی', 'is_visible' => true, 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['value' => '۹ استاد', 'caption' => 'مدرسین حرفه‌ای', 'is_visible' => true, 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['value' => 'گروهی و خصوصی', 'caption' => 'مناسب هر سطح', 'is_visible' => true, 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['value' => 'تهران مرکز', 'caption' => 'کریمخان، خیابان اراک', 'is_visible' => true, 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_stats');
    }
};
