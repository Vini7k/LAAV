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
        Schema::create('aparelhos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('marca');
            $table->string('modelo');
            $table->text('desc')->nullable();
            $table->text('obs')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparelhos');
    }
};
