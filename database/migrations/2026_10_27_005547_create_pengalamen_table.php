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
        Schema::create('Pengalaman_1156', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biodata_id');
            $table->string('perusahaan');
            $table->string('posisi');
            $table->string('tahun');
            $table->timestamps();

            $table->foreign('biodata_id')->references('id')->on('Biodata_1156')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Pengalaman_1156');
    }
};
