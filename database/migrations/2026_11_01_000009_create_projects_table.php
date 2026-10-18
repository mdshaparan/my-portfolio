<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable();      // used for the filter buttons (Web, AI ...)
            $table->text('summary')->nullable();
            $table->string('tech')->nullable();          // comma separated: Laravel, MySQL
            $table->string('badge')->nullable();         // e.g. Award Winner
            $table->string('image')->nullable();
            $table->string('live_url')->nullable();
            $table->string('source_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
