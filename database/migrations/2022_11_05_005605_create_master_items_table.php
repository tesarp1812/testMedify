<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_items', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->integer('harga_beli');
            $table->integer('laba');
            $table->string('supplier');
            $table->string('jenis');
<<<<<<< HEAD
            $table->string('foto')->nullable();
=======
>>>>>>> 59349ba4b3313a064bf732f00c507c73fff769d5
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_items');
    }
};
