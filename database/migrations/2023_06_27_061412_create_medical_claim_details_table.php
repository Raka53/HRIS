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
        Schema::create('medical_claim_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_claim_id');
            $table->foreign('medical_claim_id')->references('id')->on('medical_claims');
            $table->date('date_patient');
            $table->string('patient_name');
            $table->string('details');
            $table->float('doctor_fee');
            $table->float('obat');
            $table->float('kacamata');
            $table->float('total');
            $table->string('remarks')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_claim_details');
    }
};
