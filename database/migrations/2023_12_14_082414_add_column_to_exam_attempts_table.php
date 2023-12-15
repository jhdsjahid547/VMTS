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
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->tinyInteger('activity')->default(0)->after('exam_id');
            $table->text('result')->nullable()->after('exam_id');
            $table->text('wrong_answer')->nullable()->after('exam_id');
            $table->text('correct_answer')->nullable()->after('exam_id');
            $table->text('total_answered')->nullable()->after('exam_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropColumn('total_answered');
            $table->dropColumn('correct_answer');
            $table->dropColumn('wrong_answer');
            $table->dropColumn('result');
            $table->dropColumn('activity');
        });
    }
};
