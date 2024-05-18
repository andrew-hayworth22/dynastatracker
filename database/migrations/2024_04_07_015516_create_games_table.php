<?php

use App\Enumerators\Coverage;
use App\Enumerators\GameType;
use App\Enumerators\Location;
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
            $table->foreignIdFor(Team::class, 'opp_team_id')->constrained('teams');
            $table->enum('location', Location::strings());
            $table->enum('type', GameType::strings());
            $table->integer('week');
            $table->enum('coverage', Coverage::strings());
            $table->dateTime('date');

            // Our stats
            $table->integer('our_score_q1');
            $table->integer('our_score_q2');
            $table->integer('our_score_q3');
            $table->integer('our_score_q4');
            $table->integer('our_score_ot');

            $table->integer('our_first_downs');

            $table->integer('our_rush_att');
            $table->integer('our_rush_yds');
            $table->integer('our_rush_tds');

            $table->integer('our_pass_comp');
            $table->integer('our_pass_att');
            $table->integer('our_pass_yds');
            $table->integer('our_pass_tds');

            $table->integer('our_third_down_att');
            $table->integer('our_third_down_conv');
            $table->integer('our_fourth_down_att');
            $table->integer('our_fourth_down_conv');
            $table->integer('our_two_point_att');
            $table->integer('our_two_point_conv');

            $table->integer('our_red_zone_att');
            $table->integer('our_red_zone_fgs');
            $table->integer('our_red_zone_tds');

            $table->integer('our_fumbles_lost');
            $table->integer('our_ints');

            $table->integer('our_punt_return_yds');
            $table->integer('our_kick_return_yds');

            $table->integer('our_punts');
            $table->decimal('our_punt_avg');

            $table->integer('our_penalties');
            $table->integer('our_penalty_yds');

            $table->integer('our_top_min');
            $table->integer('our_top_sec');

            // Opponent stats
            $table->integer('opp_score_q1');
            $table->integer('opp_score_q2');
            $table->integer('opp_score_q3');
            $table->integer('opp_score_q4');
            $table->integer('opp_score_ot');

            $table->integer('opp_first_downs');

            $table->integer('opp_rush_att');
            $table->integer('opp_rush_yds');
            $table->integer('opp_rush_tds');

            $table->integer('opp_pass_comp');
            $table->integer('opp_pass_att');
            $table->integer('opp_pass_yds');
            $table->integer('opp_pass_tds');

            $table->integer('opp_third_down_att');
            $table->integer('opp_third_down_conv');
            $table->integer('opp_fourth_down_att');
            $table->integer('opp_fourth_down_conv');
            $table->integer('opp_two_point_att');
            $table->integer('opp_two_point_conv');

            $table->integer('opp_red_zone_att');
            $table->integer('opp_red_zone_fgs');
            $table->integer('opp_red_zone_tds');

            $table->integer('opp_fumbles_lost');
            $table->integer('opp_ints');

            $table->integer('opp_punt_return_yds');
            $table->integer('opp_kick_return_yds');

            $table->integer('opp_punts');
            $table->decimal('opp_punt_avg');

            $table->integer('opp_penalties');
            $table->integer('opp_penalty_yds');

            $table->integer('opp_top_min');
            $table->integer('opp_top_sec');

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
