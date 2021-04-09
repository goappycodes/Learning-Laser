<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitledLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitled_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('leave_name')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('period')->nullable();
            $table->integer('starting_month')->nullable();
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
        Schema::dropIfExists('entitled_leaves');
    }
}
