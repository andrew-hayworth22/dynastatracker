<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Division $division)
    {
        Gate::authorize('create', [Team::class, $division]);

        $data = $request->validate([
            'college_name' => ['required', 'string', 'max:255'],
            'college_abbreviation' => ['required', 'string', 'max:10'],
            'mascot' => ['required', 'string', 'max:255'],
            'location' => ['string', 'max:255'],
        ]);

        $division->teams()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
