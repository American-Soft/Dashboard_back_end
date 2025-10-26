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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('governorate');
            $table->string('region');
            $table->text('address');
            $table->string('status')->nullable()->default('pending');
            $table->text('problem_description');
            $table->boolean('warranty_status');
            $table->text('note')->nullable();
            $table->string('domain');
            $table->string('technician_name')->nullable();
            $table->timestamp('device_drag_time')->nullable();
            $table->timestamp('device_delivery_time')->nullable();
            $table->boolean('is_location')->nullable();
            $table->boolean('is_image')->nullable();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
