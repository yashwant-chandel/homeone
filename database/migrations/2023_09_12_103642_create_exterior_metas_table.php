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
        Schema::create('exterior_metas', function (Blueprint $table) {
            $table->id();
            $table->text('background_image')->nullable();
            $table->text('first_section_title')->nullable();
            $table->text('first_section_text')->nullable();
            $table->string('first_section_image')->nullable();
            $table->text('second_section_images')->nullable();
            $table->string('second_section_title')->nullable();
            $table->string('second_section_text')->nullable();
            $table->string('second_section_buttontext')->nullable();
            $table->string('last_title')->nullable();
            $table->string('last_section_images')->nullable();
            $table->string('last_section_titles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exterior_metas');
    }
};
