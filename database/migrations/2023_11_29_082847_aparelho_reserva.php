<?php

use App\Models\Aparelho;
use App\Models\Reserva;
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
        Schema::create('aparelho_reserva', function (Blueprint $table){
            $table->foreignIdFor(Aparelho::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Reserva::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparelho_reserva');
    }
};
