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
        Schema::create('delivery_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('image')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_registration')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('vehicle_brand')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_people');
    }
};
