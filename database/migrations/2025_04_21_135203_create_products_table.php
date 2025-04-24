<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('name');
            $table->string('article');
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

