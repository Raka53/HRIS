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
        Schema::create('medical_claim', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hrd_id');
            $table->foreign('hrd_id')->references('id')->on('hrd');
            $table->date('date_claim');
            $table->date('date');
            $table->string('patient');
            $table->string('doctor_fee')->nullable(0);
            $table->string('obat')->nullable(0);
            $table->string('kacamata')->nullable(0);
            $table->float('Total')->nullable(0);
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_claim');
        
    }
};
