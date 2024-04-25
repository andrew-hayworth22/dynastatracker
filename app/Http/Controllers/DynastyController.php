<?php

namespace App\Http\Controllers;

use App\Http\Resources\DynastyResource;
use App\Models\Dynasty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DynastyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Dynasty::class);

        return inertia('Dynasties/Index', [
            'dynasties' => fn () => DynastyResource::collection(auth()->user()->dynasties()->latest()->latest('id')->paginate(10))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Dynasty::class);

        return inertia('Dynasties/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Dynasty::class);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'coach_name' => ['required', 'string', 'max:255']
        ]);

        $dynasty = Dynasty::create([
            ...$data,
            'user_id' => $request->user()->id
        ]);

        return redirect(route('dynasties.show', $dynasty));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dynasty $dynasty)
    {
        Gate::authorize('view', $dynasty);

        return inertia('Dynasties/Show', [
            'dynasty' => DynastyResource::make($dynasty)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dynasty $dynasty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dynasty $dynasty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dynasty $dynasty)
    {
        //
    }
}
