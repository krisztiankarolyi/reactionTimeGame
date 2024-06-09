<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporterid');
            $table->unsignedBigInteger('reportedid');
            $table->string('details');
            $table->date('date')->default(Carbon::now());

            $table->foreign('reporterid')->references('id')->on('users');
            $table->foreign('reportedid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('reports');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
