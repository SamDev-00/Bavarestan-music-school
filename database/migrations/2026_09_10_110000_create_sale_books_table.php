<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('description')->nullable();

            // قیمت به تومان — عدد صحیح، بدون اعشار.
            $table->unsignedBigInteger('price');

            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_available', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_books');
    }
};
