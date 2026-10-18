<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('greeting')->default("Hello, I'm");
            $table->string('name');
            $table->string('role_title')->nullable();      // e.g. ML Researcher
            $table->string('tagline_prefix')->nullable();  // e.g. Passionate
            $table->text('typed_items')->nullable();       // comma separated: Web Developer, Researcher
            $table->text('intro')->nullable();
            $table->string('status_text')->nullable();     // small status line, e.g. Open to research collaborations
            $table->string('photo_tags')->nullable();      // comma separated labels shown beside the photo
            $table->text('badges')->nullable();            // comma separated small badges: IEEE CSDE 2026, 1 Paper
            $table->string('photo')->nullable();
            $table->string('btn1_text')->nullable();
            $table->string('btn1_link')->nullable();
            $table->string('btn2_text')->nullable();
            $table->string('btn2_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
