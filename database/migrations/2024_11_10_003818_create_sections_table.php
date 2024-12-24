<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->enum('subject', ['英語', '数学', '国語', '理科', '社会']);
            $table->bigInteger('number'); // sectionに対するナンバー
            $table->string('name')->unique(); // セクション名にユニーク制約
            $table->integer('passing_score')->default(0); // 合格点
            $table->timestamps();

            // 同じ教科内でnumberやnameが重複しないように複合ユニーク制約を設定
            $table->unique(['subject', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
