<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('sources.organizations')->onDelete('cascade');
//            $table->foreignId('organization_id')->constrained(config('database.connections.sources.database').'.organizations')->onDelete('cascade');
            $table->text('job_title');
            $table->string('slug')->unique();
            $table->string('job_categories');
            $table->text('vacancy')->nullable();
            $table->enum('employment_status',['full_time','part_time','contract','internship','freelance','online'])->nullable();
            $table->string('workplace')->nullable();
            $table->string('min_experience')->nullable();
            $table->string('job_location')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('salary')->nullable();
            $table->string('salary_type')->nullable();
            $table->text('job_responsibilities')->nullable();
            $table->text('educational_requirements')->nullable();
            $table->text('additional_requirements')->nullable();
            $table->text('other_benefits')->nullable();
            $table->text('job_context')->nullable();
            $table->text('job_notes')->nullable();
            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->enum('status',['draft','publish','expired', 'pending', 'declined'])->default('draft');
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
        Schema::dropIfExists('jobs');
    }
}
