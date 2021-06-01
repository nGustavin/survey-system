<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_options', function (Blueprint $table) {
            $table->increments('option_id');
            $table->unsignedInteger('survey_id');
            $table->foreign('survey_id')
                ->references('survey_id')
                ->on('surveys')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->string('option_name', 60);
            $table->timestamps();
            $table->integer('qtde')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_options');
    }
}
