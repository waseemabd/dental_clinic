<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetPatientSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_patient_sessions', function (Blueprint $table) {
            $table->bigInteger('asset_id')->unsigned();
            $table->foreign('asset_id')->references('id')->on('assets');

            $table->bigInteger('patient_session_id')->unsigned();
            $table->foreign('patient_session_id')->references('id')->on('patient_sessions');

            $table->integer('quantity')->nullable();
            $table->primary(['asset_id','patient_session_id']);
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
        Schema::dropIfExists('asset_patient_sessions');
    }
}
