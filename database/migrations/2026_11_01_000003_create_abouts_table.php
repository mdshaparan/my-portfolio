<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('heading');
            $table->string('heading_size')->default('lg');
            $table->string('photo')->nullable();
            $table->string('photo_caption')->nullable();
            $table->text('paragraph_1')->nullable();
            $table->text('paragraph_2')->nullable();
            $table->string('paragraph_size')->default('md');
            $table->string('languages')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
