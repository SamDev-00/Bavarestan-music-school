<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            // کلید یکتای انگلیسی هر تنظیم — مثلاً «instagram_url».
            $table->string('key')->unique();
            // مقدار تنظیم (متن، لینک و ...). می‌تواند خالی باشد.
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // مقادیر پیش‌فرض فعلی سایت تا چیزی از دست نرود.
        $defaults = [
            'contact_phone_primary' => '۰۹۳۵ ۵۲۱ ۸۲۵۰',
            'contact_phone_secondary' => '۰۲۱ ۸۸۹۲ ۷۴۵۸',
            'contact_hours' => 'همه‌روزه، ۱۰ تا ۲۰',
            'contact_address' => 'تهران، کریمخان، نجات‌اللهی، خیابان اراک، پلاک ۶۴، واحد ۵',
            'instagram_url' => '',
            'bale_url' => 'https://ble.ir/bavarestan_honar',
            'location_access' => 'محدوده کریمخان و خیابان نجات‌اللهی؛ نزدیک ایستگاه‌های حمل‌ونقل عمومی.',
            'neshan_url' => 'https://neshan.org/maps/share/35.7085845126421,51.41619097441435',
            'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=35.7085845,51.41619097',
            'map_embed_url' => 'https://www.openstreetmap.org/export/embed.html?bbox=51.4131910%2C35.7055845%2C51.4191910%2C35.7115845&layer=mapnik&marker=35.7085845%2C51.4161910',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('site_settings')->insert([
                'key' => $key,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
