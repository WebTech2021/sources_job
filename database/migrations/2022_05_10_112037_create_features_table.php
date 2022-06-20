<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_data_id')->constrained('feature_data')->onDelete('cascade');
            $table->string('featurable_type');
            $table->unsignedBigInteger('featurable_id');
            $table->dateTime('expired')->nullable();
            $table->enum('type',['feature','urgent','promote'])->default('feature');
            $table->enum('status',['pending','approved','unapproved','expired'])->default('pending');
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
        Schema::dropIfExists('features');
    }
}
