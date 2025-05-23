<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('jenis_kelamin')->nullable();
            $table->string('no_hp')->nullable();
            $table->longText('alamat')->nullable();
            $table->longText('status')->nullable();
            $table->bigInteger('id_meja')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_meja')->references('id')->on('meja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
