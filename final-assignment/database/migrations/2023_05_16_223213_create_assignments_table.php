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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('question', 1000)->nullable(true);
            $table->string('image_path')->nullable(true);
            $table->string('solution', 1000)->nullable(true);
            $table->string('answer')->nullable(true);
            $table->string('status')->nullable(true);
            $table->integer('points')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
