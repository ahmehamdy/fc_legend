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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->date('match_date');
            $table->string('opponent');
            $table->integer('home_score')->default(0);
            $table->integer('away_score')->default(0);
            $table->enum('status', [
                'upcoming',
                'live',
                'finished'
            ]);
            $table->enum('result', [
                'win',
                'loss',
                'draw'
            ])->nullable();
            $table->string('league');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
