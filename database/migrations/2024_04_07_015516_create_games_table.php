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
            $table->enum('location', ['Home', 'Away', 'Neutral']);
            $table->enum('type', ['Regular Season', 'Conference Championship', 'Bowl Game', 'National Octafinals', 'National Quarterfinals', 'National Semifinals', 'National Championship']);
            $table->dateTime('date');

            // Our stats
            $table->integer('our_score_q1');
            $table->integer('our_score_q2');
            $table->integer('our_score_q3');
            $table->integer('our_score_q4');

            $table->integer('our_first_downs');

            $table->integer('our_third_down_att');
            $table->integer('our_third_down_conv');
            $table->integer('our_fourth_down_att');
            $table->integer('our_fourth_down_conv');
            $table->integer('our_two_point_att');
            $table->integer('our_two_point_conv');
            $table->integer('our_red_zone_att');
            $table->integer('our_red_zone_fg');
            $table->integer('our_red_zone_td');

            $table->integer('our_fumbles_lost');

            $table->integer('our_penalties');
            $table->integer('our_penalty_yds');

            $table->integer('our_top_min');
            $table->integer('our_top_sec');

            // Opponent stats
            $table->integer('opponent_score_q1');
            $table->integer('opponent_score_q2');
            $table->integer('opponent_score_q3');
            $table->integer('opponent_score_q4');

            $table->integer('opponent_first_downs');

            $table->integer('opponent_rush_att');
            $table->integer('opponent_rush_yds');
            $table->integer('opponent_rush_tds');

            $table->integer('opponent_pass_comp');
            $table->integer('opponent_pass_att');
            $table->integer('opponent_pass_yds');
            $table->integer('opponent_pass_tds');

            $table->integer('opponent_third_down_att');
            $table->integer('opponent_third_down_conv');
            $table->integer('opponent_fourth_down_att');
            $table->integer('opponent_fourth_down_conv');
            $table->integer('opponent_two_point_att');
            $table->integer('opponent_two_point_conv');
            $table->integer('opponent_red_zone_att');
            $table->integer('opponent_red_zone_fg');
            $table->integer('opponent_red_zone_td');

            $table->integer('opponent_fumbles_lost');
            $table->integer('opponent_ints');

            $table->integer('opponent_punt_return_yds');
            $table->integer('opponent_kick_return_yds');

            $table->integer('opponent_punts');
            $table->integer('opponent_punt_avg');

            $table->integer('opponent_penalties');
            $table->integer('opponent_penalty_yds');

            $table->integer('opponent_top_min');
            $table->integer('opponent_top_sec');

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
