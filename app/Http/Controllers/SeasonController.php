<?php

namespace App\Http\Controllers;

use App\Enumerators\CoachType;
use App\Http\Resources\DynastyResource;
use App\Http\Resources\GameLogResource;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\TeamResource;
use App\Models\Dynasty;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dynasty $dynasty)
    {
        Gate::authorize('viewAny', [Season::class, $dynasty]);

        return inertia('Seasons/Index', [
            'dynasty' => fn () => DynastyResource::make($dynasty),
            'seasons' => fn () => SeasonResource::collection($dynasty->seasons()->latest('year')->latest()->get()->load(['team', 'games'])),
            'teams' => fn () => TeamResource::collection($dynasty->teams),
            'coachTypes' => CoachType::strings()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Dynasty $dynasty)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dynasty $dynasty)
    {
        Gate::authorize('create', [Season::class, $dynasty]);

        $data = $request->validate([
            'year' => [
                'required', 'integer', 'min:1900', 'max:2100',
                Rule::unique('seasons', 'year')->where('dynasty_id', $dynasty->id)
            ],
            'coach_type' => ['required', 'string', 'in:OC,DC,HC'],
            'team_id' => ['required', 'exists:teams,id']
        ]);

        $season = $dynasty->seasons()->create($data);

        return redirect()->route('seasons.show', $season->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Season $season)
    {
        Gate::authorize('view', $season);

        $games = $season->games()->with('opp_team')->orderBy('date')->get();

        return inertia('Seasons/Show', [
            'season' => fn () => SeasonResource::make($season->load('team')),
            'games' => fn () => GameLogResource::collection($games)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        //
    }

    /**
     * Display the roster for the specified season.
     */
    public function roster(Season $season)
    {
        Gate::authorize('view', $season);

        return inertia('Seasons/Roster', [
            'dynasty' => fn () => DynastyResource::make($season->dynasty),
            'season' => fn () => SeasonResource::make($season->load('team')),
            'players' => fn () => PlayerResource::collection($season->players),
        ]);
    }
}
