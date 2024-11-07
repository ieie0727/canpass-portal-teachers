<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('role', ['teacher', 'admin'])->default('teacher');
            $table->string('family_name');
            $table->string('given_name');
            $table->string('email_company', 255);
            $table->string('phone_company', 20)->nullable();
            $table->string('email_private', 255)->nullable();
            $table->string('phone_private', 20)->nullable();
            $table->date('birth_date');
            $table->date('hire_date');
            $table->date('retirement_date')->nullable()->default(null);
            $table->enum('status', ['稼働', '休職', '退職'])->default('稼働');
            $table->string('meeting_url', 255)->nullable();
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
