<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoproprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coproprietaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('ville');
            $table->string('region');
            $table->integer('zip');

            $table->integer('nb_app');
            $table->integer('nb_bloc');
            $table->integer('nb_lc');
            $table->integer('nb_p');
            $table->integer('nb_log');
            $table->integer('admin_id');
           

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
        Schema::dropIfExists('coproprietaires');
    }
}
