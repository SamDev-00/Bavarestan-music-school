<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            // کلاس انتخاب‌شده — نام استاد و ساز در زمان ثبت‌نام نگه داشته می‌شود
            // تا تغییر بعدی config/school.php سابقهٔ ثبت‌نام‌ها را خراب نکند.
            $table->string('teacher_slug', 64);
            $table->string('teacher_name');
            $table->string('instrument');
            $table->string('day', 32);
            $table->string('slot', 5);

            // هویت هنرجو
            $table->string('national_id', 10);
            $table->string('name');
            $table->string('phone', 20);

            // اطلاعات تکمیلی
            $table->string('education')->nullable();
            $table->string('level')->nullable();
            $table->string('mode')->nullable();
            $table->string('referral_source')->nullable();
            $table->string('referrer')->nullable();
            $table->text('message')->nullable();

            $table->timestamps();

            // هر بازهٔ زمانی هر استاد فقط یک هنرجو دارد.
            $table->unique(['teacher_slug', 'slot']);

            // هر کد ملی برای هر استاد فقط یک بار — جلوگیری از ثبت تکراری.
            $table->unique(['national_id', 'teacher_slug']);

            $table->index(['national_id', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
