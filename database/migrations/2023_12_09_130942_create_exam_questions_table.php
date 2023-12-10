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
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->text('question')->nullable();
            $table->text('choice_one')->nullable();
            $table->text('choice_two')->nullable();
            $table->text('choice_three')->nullable();
            $table->text('choice_four')->nullable();
            $table->text('correct_answer')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
