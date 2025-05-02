<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->id();  // Автоинкрементный первичный ключ (аналог SERIAL PRIMARY KEY)
            $table->text('title');  // TEXT NOT NULL → string (VARCHAR по умолчанию)
            $table->text('image_url');  // Ссылка на изображение
            $table->decimal('price', 10, 2);  // DECIMAL(10, 2)
            $table->text('category');  // Категория товара
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_products');
    }
};
