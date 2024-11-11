<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->index();
            $table->text('question_text')->nullable();
            $table->string('question_image')->nullable();
            $table->integer('number'); // 問題番号
            $table->string('choice1', 255);
            $table->string('choice2', 255);
            $table->string('choice3', 255);
            $table->string('choice4', 255);
            $table->integer('correct_answer');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

            // 同じセクション内で同じnumberが重複しないように複合ユニーク制約を追加
            $table->unique(['section_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
