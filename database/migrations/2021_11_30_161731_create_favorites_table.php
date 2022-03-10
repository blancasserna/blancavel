<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('idFavorite');
            $table->timestamps();
            $table->unsignedBigInteger('idVideoF');
            $table->foreign('idVideoF')->references('id')->on('videos')
            ->onDelete('cascade');
            $table->unsignedBigInteger('idUserF');
            $table->foreign('idUserF')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
