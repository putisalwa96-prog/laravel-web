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
        Schema::create('Dokumen_1156', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biodata_id');
            $table->string('nama');
            $table->string('file');
            $table->timestamps();

            $table->foreign('biodata_id')->references('id')->on('Biodata_1156')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Dokumen_1156');
    }
};
