<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DivisionController extends Controller
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
    public function store(Request $request, Conference $conference)
    {

        Gate::authorize('create', [Division::class, $conference]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $conference->divisions()->create($data);

        return redirect()->route('dynasties.conferences.index', $conference->dynasty_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        //
    }
}
