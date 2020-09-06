<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vacancy')->nullable();
            $table->integer('quantity')->nullable();
            $table->date('end_date')->nullable();
            $table->text('photo')->nullable();
            $table->text('description')->nullable();
            $table->text('entitlements')->nullable();
            $table->text('job_requirements')->nullable();
            $table->text('requested_documents')->nullable();
            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employers');
            $table->unsignedBigInteger('rank_id');
            $table->foreign('rank_id')->references('id')->on('ranks');
            $table->unsignedBigInteger('type_of_work_id');
            $table->foreign('type_of_work_id')->references('id')->on('type_of_works');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')->references('id')->on('careers');
            $table->unsignedBigInteger('salary_id');
            $table->foreign('salary_id')->references('id')->on('salaries');
            $table->boolean('active')->default(false);
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('recruitments');
    }
}
