<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->text('image')->nullable();
            $table->date('dob')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nid')->unique()->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('language')->nullable();
            $table->string('p_address')->nullable();
            $table->string('c_location')->nullable();
            $table->string('experience')->nullable();
            $table->string('skills')->nullable();
            $table->string('available_status')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->OnUpdate('cascade')->onDelete('cascade');
            $table->foreignId('division_id')->nullable()->constrained()->OnUpdate('cascade')->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->OnUpdate('cascade')->onDelete('cascade');
            $table->foreignId('upazila_id')->nullable()->constrained()->OnUpdate('cascade')->onDelete('cascade');
            $table->string('post_code')->nullable();
            $table->enum('status',['active','inactive','blocked'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->string('password');
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('google_plus_url')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seekers');
    }
}
