<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("ticket_contents")->nullable();
            $table->bigInteger('user_id')->default(0)->unsigned();
            $table->bigInteger('category_id')->default(0)->unsigned();
            $table->bigInteger('open')->unsigned();
            $table->bigInteger('status')->unsigned();
            $table->bigInteger('priority')->unsigned();
            $table->string('progress')->default("0");
            $table->float('work_hours')->default(0.0);
            $table->date('sStartAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('sFinishAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('startAt')->nullable();
            $table->date('finishAt')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
