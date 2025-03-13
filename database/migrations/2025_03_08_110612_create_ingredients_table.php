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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->double('price')->default(0);
            $table->timestamps();
        });

        Schema::create('nutritional_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->unique()->constrained('ingredients')->cascadeOnDelete();
            $table->integer('calories')->default(0);
            $table->integer('protein')->default(0);
            $table->integer('carbs')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('fiber')->default(0);
            $table->integer('sugar')->default(0);
            $table->integer('sodium')->default(0);
            $table->integer('cholesterol')->default(0);
            $table->json('others')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
