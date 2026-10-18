<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('degree');                     // e.g. BSc in Computer Science and Engineering
            $table->string('institution');                // e.g. American International University-Bangladesh
            $table->string('location')->nullable();       // e.g. Dhaka, Bangladesh
            $table->string('period');                     // free text, e.g. 2022 - Expected 2027
            $table->string('grade')->nullable();          // free text, e.g. CGPA 3.80 / 4.00
            $table->text('description')->nullable();      // optional details, one line = one bullet
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
