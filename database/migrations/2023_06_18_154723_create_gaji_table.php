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
            $table->decimal('harga_sewa', 15, 2); // Example: up to 9999999999999.99
            $table->decimal('salary', 15, 2);
            $table->date('start_date_medical');
            $table->date('end_date_medical');
            $table->decimal('lembur', 15, 2);
            $table->decimal('total_medical_claim', 15, 2);
            $table->decimal('transport', 15, 2);
            $table->decimal('meals', 15, 2);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
