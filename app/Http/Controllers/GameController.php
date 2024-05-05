<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameViewResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\TeamResource;
use App\Models\Game;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Season $season)
    {
        Gate::authorize('create', [Game::class, $season]);

        return inertia('Games/Create', [
            'season' => SeasonResource::make($season->load(['dynasty', 'team'])),
            'teams' => TeamResource::collection($season->dynasty->teams()->orderBy('college_abbreviation')->get()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Season $season)
    {
        Gate::authorize('create', [Game::class, $season]);

        $data = $request->validate([
            'opp_team_id' => ['required', 'exists:teams,id'],
            'location' => ['required', 'string'],
            'type' => ['required', 'string'],
            'week' => ['required_if:type,==,Regular Season', 'integer'],
            'coverage' => ['required', 'string'],
            'date' => ['required', 'date'],
            'our_score_q1' => ['required', 'integer'],
            'our_score_q2' => ['required', 'integer'],
            'our_score_q3' => ['required', 'integer'],
            'our_score_q4' => ['required', 'integer'],
            'our_score_ot' => ['required', 'integer'],
            'our_first_downs' => ['required', 'integer'],
            'our_rush_att' => ['required', 'integer'],
            'our_rush_yds' => ['required', 'integer'],
            'our_rush_tds' => ['required', 'integer'],
            'our_pass_comp' => ['required', 'integer'],
            'our_pass_att' => ['required', 'integer'],
            'our_pass_yds' => ['required', 'integer'],
            'our_pass_tds' => ['required', 'integer'],
            'our_third_down_att' => ['required', 'integer'],
            'our_third_down_conv' => ['required', 'integer'],
            'our_fourth_down_att' => ['required', 'integer'],
            'our_fourth_down_conv' => ['required', 'integer'],
            'our_two_point_att' => ['required', 'integer'],
            'our_two_point_conv' => ['required', 'integer'],
            'our_red_zone_att' => ['required', 'integer'],
            'our_red_zone_fgs' => ['required', 'integer'],
            'our_red_zone_tds' => ['required', 'integer'],
            'our_fumbles_lost' => ['required', 'integer'],
            'our_ints' => ['required', 'integer'],
            'our_punt_return_yds' => ['required', 'integer'],
            'our_kick_return_yds' => ['required', 'integer'],
            'our_punts' => ['required', 'integer'],
            'our_punt_avg' => ['required', 'decimal:0,2'],
            'our_penalties' => ['required', 'integer'],
            'our_penalty_yds' => ['required', 'integer'],
            'our_top_min' => ['required', 'integer'],
            'our_top_sec' => ['required', 'integer'],
            'opp_score_q1' => ['required', 'integer'],
            'opp_score_q2' => ['required', 'integer'],
            'opp_score_q3' => ['required', 'integer'],
            'opp_score_q4' => ['required', 'integer'],
            'opp_score_ot' => ['required', 'integer'],
            'opp_first_downs' => ['required', 'integer'],
            'opp_rush_att' => ['required', 'integer'],
            'opp_rush_yds' => ['required', 'integer'],
            'opp_rush_tds' => ['required', 'integer'],
            'opp_pass_comp' => ['required', 'integer'],
            'opp_pass_att' => ['required', 'integer'],
            'opp_pass_yds' => ['required', 'integer'],
            'opp_pass_tds' => ['required', 'integer'],
            'opp_third_down_att' => ['required', 'integer'],
            'opp_third_down_conv' => ['required', 'integer'],
            'opp_fourth_down_att' => ['required', 'integer'],
            'opp_fourth_down_conv' => ['required', 'integer'],
            'opp_two_point_att' => ['required', 'integer'],
            'opp_two_point_conv' => ['required', 'integer'],
            'opp_red_zone_att' => ['required', 'integer'],
            'opp_red_zone_fgs' => ['required', 'integer'],
            'opp_red_zone_tds' => ['required', 'integer'],
            'opp_fumbles_lost' => ['required', 'integer'],
            'opp_ints' => ['required', 'integer'],
            'opp_punt_return_yds' => ['required', 'integer'],
            'opp_kick_return_yds' => ['required', 'integer'],
            'opp_punts' => ['required', 'integer'],
            'opp_punt_avg' => ['required', 'decimal:0,2'],
            'opp_penalties' => ['required', 'integer'],
            'opp_penalty_yds' => ['required', 'integer'],
            'opp_top_min' => ['required', 'integer'],
            'opp_top_sec' => ['required', 'integer'],
        ]);

        $season->games()->create($data);

        return redirect()->route('seasons.show', $season);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        Gate::authorize('view', $game);

        return inertia('Games/Show', [
            'game' => GameViewResource::make($game->load(['season', 'opp_team'])),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
