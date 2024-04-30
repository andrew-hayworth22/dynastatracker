<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
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
