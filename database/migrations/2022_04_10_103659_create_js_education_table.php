<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJsEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('js_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->string('education_level');
            $table->string('degree_title');
            $table->string('education_board')->nullable();
            $table->string('group')->nullable();
            $table->string('institute_name');
            $table->string('phd_title')->nullable();
            $table->string('result');
            $table->integer('passing_year');
            $table->string('scale')->nullable();
            $table->string('mark')->nullable();
            $table->string('cgpa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('js_education');
    }
}
