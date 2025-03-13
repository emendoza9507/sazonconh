<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plate_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('plates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('plate_categories')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->double('price')->default(0);
            $table->json('images')->default(new Expression('(JSON_ARRAY())'));
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });

        Schema::create('ingredient_plate', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plate_id')->constrained('plates')->cascadeOnDelete();
            $table->foreignId('ingredient_id')->constrained('ingredients')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plates');
    }
};
