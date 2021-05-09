<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvrecruitments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cv_id');
            $table->foreign('cv_id')->references('id')->on('curriculumvitaes');
            $table->unsignedBigInteger('recruitment_id');
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');;
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
        Schema::dropIfExists('cv_recruitments');
    }
}
