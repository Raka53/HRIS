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
        Schema::create('hrd', function (Blueprint $table) {
            $table->id();
            $table->string('NIK')->unique();
            $table->string('statusKry');
            $table->string('name');
            $table->string('gender');
            $table->date('joindate');
            $table->string('location');
            $table->string('department');
            $table->string('joblevel');
            $table->string('jobtitle');
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
        Schema::dropIfExists('hrd');
    }
};
