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
        Schema::create('posisi_kdt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->foreign('kandidat_id')->references('id')->on('kandidat');
            $table->string('pengalaman_terakhir')->nullable();
            $table->string('posisi_terakhir')->nullable();
            $table->string('posisi1');
            $table->string('posisi2')->nullable();
            $table->string('dokumen');
            $table->string('penampilan')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisi_kdt');
    }
};
