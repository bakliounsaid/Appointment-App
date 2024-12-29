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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('localisation')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->date('client_date');
            $table->date('admin_date')->nullable();
            $table->date('assembly_date')->nullable();
            $table->integer('windows')->nullable();
            $table->text('description')->nullable();
            $table->boolean('seen')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
