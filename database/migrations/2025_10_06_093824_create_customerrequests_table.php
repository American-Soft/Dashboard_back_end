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
        Schema::create('customerrequests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('whatsapp_number');
            $table->string('whatsapp_number_code');
            $table->string('email')->nullable();
            $table->string('city');
            $table->string('governorate');
            $table->string('region');
            $table->text('address');
            $table->string('status')->default('pending');
            $table->text('problem_description');
            $table->boolean('warranty_status');
            $table->text('note');
            $table->string('domain');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customerrequests');
    }
};
