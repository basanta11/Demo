<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFeildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_feild', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
	        $table->unsignedBigInteger('feild_id');

	        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
	        $table->foreign('feild_id')->references('id')->on('feilds')->onDelete('cascade');
  
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
        Schema::dropIfExists('category_feild');
    }
}
