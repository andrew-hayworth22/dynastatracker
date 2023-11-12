<?php

namespace App\Http\Controllers;

use App\Models\Dynasty;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ConferenceController extends Controller
{
    // View teams in a dynasty
    public function index($id) : Response {
        $dynasty = Dynasty::with('conferences.divisions.teams')->find($id);

        if($dynasty->user_id != auth()->user()->id)
            return Inertia::render('Unauthorized');

        return Inertia::render('Dynasty/Teams', [
            'dynastyId' => $dynasty->id,
            'dynastyName' => $dynasty->name,
            'conferences' => $dynasty->conferences
        ]);
    }

    // Create a conference
    public function store(Request $request, int $dynastyId) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:10'],
        ]);

        $dynasty = Dynasty::query()->find($dynastyId);

        if($dynasty->user_id != auth()->user()->id)
            return;

        $dynasty->conferences()->create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation
        ]);
    }
}
