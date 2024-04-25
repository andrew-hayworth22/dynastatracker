<?php

use App\Models\Player;
use App\Models\Position;
use App\Models\Season;
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
        Schema::create('player_season', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Player::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->enum('year', ['FR', 'FR (RS)', 'SO', 'SO (RS)', 'JR', 'JR (RS)', 'SR', 'SR (RS)']);
            $table->foreignIdFor(Position::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_season');
    }
};
