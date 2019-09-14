<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('ratings', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('helpful')->default('yes');
         $table->string('message')->nullable();
         $table->unsignedBigInteger('article_id');
         $table->foreign('article_id')->references('id')->on('articles');
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
      Schema::dropIfExists('ratings');
   }
}
