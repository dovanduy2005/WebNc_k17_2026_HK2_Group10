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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('contract_number')->unique();
            $table->string('cccd');
            $table->string('phone');
            $table->text('buyer_address');
            $table->text('store_address');
            $table->decimal('deposit_amount', 15, 2);
            $table->string('deposit_image')->nullable();
            $table->enum('status', ['pending', 'signed', 'completed'])->default('pending');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
