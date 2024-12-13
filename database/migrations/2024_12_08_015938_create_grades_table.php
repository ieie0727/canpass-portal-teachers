<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->tinyInteger('grade');
            $table->tinyInteger('term');
            $table->unsignedTinyInteger('japanese')->default(0);
            $table->unsignedTinyInteger('math')->default(0);
            $table->unsignedTinyInteger('english')->default(0);
            $table->unsignedTinyInteger('social')->default(0);
            $table->unsignedTinyInteger('science')->default(0);
            $table->unsignedTinyInteger('music')->default(0);
            $table->unsignedTinyInteger('art')->default(0);
            $table->unsignedTinyInteger('physical')->default(0);
            $table->unsignedTinyInteger('industrial')->default(0);
            $table->timestamps();

            //外部キー制約やユニーク
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unique(['student_id', 'grade', 'term']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
