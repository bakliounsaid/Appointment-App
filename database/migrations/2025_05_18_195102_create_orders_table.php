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
            $table->string('fullname');
            $table->string('client_phone');
            $table->string('client_address')->nullable();
            $table->boolean('delivery_method');
            $table->decimal('delivery_fees', 10, 2)->nullable();
            $table->enum('delivery_service', ['ZR', 'Default'])->default('ZR');
            $table->string('client_email')->nullable();
            $table->string('tracking_code')->nullable();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
