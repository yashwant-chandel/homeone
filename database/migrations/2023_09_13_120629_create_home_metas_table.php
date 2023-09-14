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
        Schema::create('home_metas', function (Blueprint $table) {
            $table->id();
            $table->string('background_image')->nullable();
            $table->string('title')->nullable();
            $table->string('about_us_title')->nullable();
            $table->string('about_us_subtitle')->nullable();
            $table->string('about_us_image')->nullable();
            $table->string('about_us_text')->nullable();
            $table->text('middle_section_title')->nullable();
            $table->text('middle_section_text')->nullable();
            $table->string('middle_section_image')->nullable();
            $table->string('middle_button_text')->nullable();
            $table->text('last_section_title')->nullable();
            $table->text('last_section_text')->nullable();
            $table->string('last_section_button_text')->nulllable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_metas');
    }
};
