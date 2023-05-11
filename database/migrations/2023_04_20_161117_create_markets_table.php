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
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('location_ar')->nullable();
            $table->string('location_en')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('panner')->nullable();
            $table->string('password')->nullable();
            $table->string('code')->nullable();
            $table->string('min_from')->nullable();
            $table->string('min_to')->nullable();
            $table->double('price')->nullable();
            $table->double('rating')->nullable();
            $table->enum('block',['yes','no'])->default('no');
            $table->enum('is_available',['yes','no'])->default('yes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
