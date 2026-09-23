<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // یک جملهٔ کوتاه معرفی زیر نام استاد در صفحهٔ اختصاصی.
            $table->string('headline')->nullable()->after('photo');
            // بیوگرافی و متن کامل صفحهٔ استاد (HTML).
            $table->longText('bio')->nullable()->after('headline');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn(['headline', 'bio']);
        });
    }
};
