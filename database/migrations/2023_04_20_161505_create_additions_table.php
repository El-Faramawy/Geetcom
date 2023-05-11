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
        Schema::create('additions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addition_category_id')->nullable();
            $table->foreign('addition_category_id')->on('addition_categories')->references('id')->onDelete('cascade');

            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->double('price')->default(0.0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additions');
    }
};
