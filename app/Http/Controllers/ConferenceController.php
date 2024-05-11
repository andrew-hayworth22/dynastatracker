<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConferenceResource;
use App\Http\Resources\DynastyResource;
use App\Models\Conference;
use App\Models\Dynasty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dynasty $dynasty)
    {
        Gate::authorize('viewAny', [Conference::class, $dynasty]);

        return inertia('Conferences/Index', [
            'dynasty' => fn () => DynastyResource::make($dynasty),
            'conferences' => fn () => ConferenceResource::collection($dynasty->conferences->load('divisions')->load('divisions.teams'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Dynasty $dynasty)
    {
        Gate::authorize('create', [Conference::class, $dynasty]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:255']
        ]);

        $dynasty->conferences()->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conference $conference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Conference $conference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conference $conference)
    {
        //
    }
}
