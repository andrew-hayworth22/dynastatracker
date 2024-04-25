<?php

namespace App\Http\Controllers;

use App\Filters\IsActiveFilter;
use App\Http\Resources\DynastyResource;
use App\Http\Resources\PlayerResource;
use App\Models\Dynasty;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dynasty $dynasty)
    {
        Gate::authorize('viewAny', [Player::class, $dynasty]);

        $players = QueryBuilder::for($dynasty->players())
            ->defaultSort('last_name')
            ->allowedFilters([
                AllowedFilter::custom('is_active', new IsActiveFilter)->default('Active'),
            ])
            ->paginate(25);

        return inertia('Players/Index', [
            'filter' => fn () => request('filter', ['is_active' => 'Active']),
            'dynasty' => fn () => DynastyResource::make($dynasty),
            'players' => fn () => PlayerResource::collection($players),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dynasty $dynasty)
    {
        Gate::authorize('create', [Player::class, $dynasty]);

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'weight_lbs' => ['required', 'integer', 'min:1', 'max:500'],
            'height_ft' => ['required', 'integer', 'min:3', 'max:8'],
            'height_in' => ['required', 'integer', 'min:0', 'max:11']
        ]);

        $dynasty->players()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        Gate::authorize('update', $player);

        $data = $request->validate([
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'weight_lbs' => ['integer', 'min:1', 'max:500'],
            'height_ft' => ['integer', 'min:3', 'max:8'],
            'height_in' => ['integer', 'min:0', 'max:11'],
            'is_active' => ['boolean'],
            'reason_left' => ['nullable', 'string', 'max:255']
        ]);

        $player->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
