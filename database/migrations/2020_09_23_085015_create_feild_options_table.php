<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeildOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feild_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feild_id')->nullable();
            $table->foreign('feild_id')->references('id')->on('feilds');    
        $table->string('value')->nullable();
    $table->softDeletes();

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
        Schema::dropIfExists('feild_options');
    }
}
