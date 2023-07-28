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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hrd_id');
            $table->foreign('hrd_id')->references('id')->on('hrd');
            $table->string('sewa');
            $table->float('salary');
            $table->date('start_date_medical');
            $table->date('end_date_medical');
            $table->float('lembur');
            $table->float('total_medical_claim');
            $table->float('transport');
            $table->float('meals');
            $table->float('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
