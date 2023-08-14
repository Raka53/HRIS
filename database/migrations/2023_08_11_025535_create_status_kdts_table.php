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
        Schema::create('status_kdt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->foreign('kandidat_id')->references('id')->on('kandidat');
            $table->string('interview_user')->nullable();
            $table->string('interview_MR')->nullable();
            $table->string('interview_FG')->nullable();
            $table->string('posisi_usulan')->nullable();
            $table->string('status_hasil')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_kdt');
    }
};
