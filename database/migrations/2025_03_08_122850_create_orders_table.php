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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('delivery_person_id')->nullable()->constrained('delivery_people');
            $table->foreignId('address_id')->constrained('addresses');
            $table->string('order_number', 45)->unique();
            $table->string('status', 45);
            $table->string('payment_status', 45);
            $table->string('payment_method', 45);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->text('notes')->nullable();
            $table->datetime('estimated_delivery_time')->nullable();
            $table->datetime('actual_delivery_time')->nullable();
            $table->datetime('scheduled_delivery')->nullable();
            $table->text('preparation_notes')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->string('device_type')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('status', 45);
            $table->text('notes')->nullable();
            $table->foreignId('changed_by_user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_history');
        Schema::dropIfExists('orders');
    }
};
