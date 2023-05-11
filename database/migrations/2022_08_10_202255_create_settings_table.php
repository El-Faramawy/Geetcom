<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable();
            $table->text('support')->nullable();
            $table->text('privacy')->nullable();
            $table->text('about')->nullable();
            $table->text('terms')->nullable();
            $table->text('bonus')->nullable();
            $table->text('bonus_per')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
