<?php

namespace App\Http\Controllers;

use App\Models\Dynasty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DynastyController extends Controller
{
    // Return view of user's dynasties
    public function index(Request $request) : Response {
        return Inertia::render('Dashboard');
    }

    // Create a dynasty
    public function store(Request $request) : RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'coach_name' => ['required', 'string', 'max:255'],
        ]);

        $dynasty = auth()->user()->dynasties()->create([
            'name' => $request->name,
            'coach_name' => $request->coach_name,
            'status' => 'Active'
        ]);

        return to_route('dynasty.show', ['id' => $dynasty->id]);
    }

    // Delete a dynasty
    public function destroy($id) : RedirectResponse {
        $dynasty = Dynasty::query()->find($id);

        if(auth()->user()->id != $dynasty->user_id)
            return to_route('dashboard');

        $dynasty->delete();
        return to_route('dashboard');
    }

    // View a dynasty
    public function show($id) : Response {
        $dynasty = Dynasty::query()->find($id);

        if($dynasty->user_id != auth()->user()->id)
            return Inertia::render('Unauthorized');

        return Inertia::render('Dynasty/Dashboard', [
            'dynasty' => $dynasty
        ]);
    }
}
