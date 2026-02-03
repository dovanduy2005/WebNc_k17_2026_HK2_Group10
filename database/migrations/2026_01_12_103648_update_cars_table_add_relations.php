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
        Schema::table('cars', function (Blueprint $table) {
            // Thêm foreign keys
            $table->foreignId('brand_id')->nullable()->after('id')->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->after('brand_id')->constrained()->onDelete('set null');
            
            // Thêm các cột mới
            $table->integer('mileage')->default(0)->after('year'); // Số km đã đi
            $table->enum('status', ['available', 'sold', 'reserved'])->default('available')->after('is_hot');
            
            // Xóa cột brand cũ (string) - sẽ dùng relation
            $table->dropColumn('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['brand_id', 'category_id', 'mileage', 'status']);
            $table->string('brand')->after('name');
        });
    }
};
