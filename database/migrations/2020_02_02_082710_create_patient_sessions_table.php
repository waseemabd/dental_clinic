<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('description')->nullable();
            $table->text('note')->nullable();;

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('patient_statuses')->onDelete('cascade');;

            $table->bigInteger('payment_type_id')->unsigned()->nullable();
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');;

            $table->timestamp('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_delayed')->default(false);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('patient_sessions');
    }
}
