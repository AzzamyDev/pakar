<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsikologsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psikologs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_telpon');
            $table->string('alamat');
            $table->string('image_name');
            $table->string('path_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psikologs');
    }
}
