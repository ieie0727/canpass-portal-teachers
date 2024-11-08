<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('role', ['student', 'admin'])->default('student');
            $table->string('family_name');
            $table->string('given_name');
            $table->string('email', 255)->unique();
            $table->date('birth_date');
            $table->date('admission_date')->index();
            $table->date('withdrawal_date')->nullable()->default(null);
            $table->enum('status', ['在籍', '休塾', '退塾'])->default('在籍')->index();
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
