<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // عکس انتهای صفحهٔ بیوگرافی — با هر ابعادی، بدون برش.
            $table->string('footer_image')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('footer_image');
        });
    }
};
