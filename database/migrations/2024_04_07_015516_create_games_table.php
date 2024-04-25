<?php

use App\Models\Season;
use App\Models\Team;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Team::class, 'opponent_team_id')->constrained('teams');
            $table->enum('location', ['home', 'away', 'neutral']);
            $table->dateTime('date');

            $table->integer('our_score');

            $table->integer('opponent_score');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
