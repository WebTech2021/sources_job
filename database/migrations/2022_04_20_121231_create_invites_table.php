<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained(config('database.connections.sources.database').'.organizations')->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->enum('status',['pending','accept','reject'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
