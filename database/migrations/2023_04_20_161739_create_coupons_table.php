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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->enum('type',['value','percentage'])->default('value');
            $table->double('value')->default(0.0);
            $table->double('percentage')->default(0.0);
            $table->double('min_price')->default(0.0);
            $table->double('max_price')->default(0.0);
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
        Schema::dropIfExists('coupons');
    }
};
