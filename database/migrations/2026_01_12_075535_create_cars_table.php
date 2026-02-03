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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->bigInteger('price');
            $table->integer('year');
            $table->string('type');
            $table->string('image');
            $table->json('images');
            $table->string('engine');
            $table->string('power');
            $table->string('transmission');
            $table->string('fuel');
            $table->integer('seats');
            $table->text('description');
            $table->boolean('is_hot')->default(false);
            $table->integer('discount')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
