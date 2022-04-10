<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerAndApplicationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_and_application_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->text('objective')->nullable();
            $table->string('present_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('job_level')->nullable();
            $table->string('job_nature')->nullable();
            $table->string('pre_job_categories')->nullable();
            $table->string('pre_job_location')->nullable();
            $table->string('pre_organization_type')->nullable();
            $table->text('career_summary')->nullable();
            $table->text('special_qualification')->nullable();
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
        Schema::dropIfExists('career_and_application_information');
    }
}
