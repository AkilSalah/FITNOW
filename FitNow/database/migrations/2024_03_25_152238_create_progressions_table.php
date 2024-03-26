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
        Schema::create('progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->integer('poids');
            $table->integer('Poitrine');
            $table->integer('Mollet');
            $table->integer('Bras');
            $table->integer('Hauteur');
            $table->integer('PoidsLeve');
            $table->integer('TempsDeCourse');
            $table->enum('status',['terminé' ,'NonTerminé'])->default('NonTerminé');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressions');
    }
};
