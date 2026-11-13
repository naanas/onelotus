<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerawatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perawatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pasien_id');
            $table->string('keluhan')->nullable();
            $table->string('analisa')->nullable();
            $table->string('treatment')->nullable();
            $table->string('bagian_penenang')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('terapis')->nullable();
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
        Schema::dropIfExists('perawatan');
    }
}
