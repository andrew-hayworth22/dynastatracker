<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Create a team
    public function store(Request $request, int $divisionId) {
        $request->validate([
            'college_name' => ['required', 'string', 'max:255'],
            'abbrev_college_name' => ['required', 'string', 'max:255'],
            'mascot_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255']
        ]);

        $division = Division::query()->find($divisionId);

        if($division->conference->dynasty->user_id != auth()->user()->id)
            return;

        $division->teams()->create([
            'college_name' => $request->college_name,
            'abbrev_college_name' => $request->abbrev_college_name,
            'mascot_name' => $request->mascot_name,
            'location' => $request->location
        ]);
    }

    // Update a team
    public function update(Request $request, int $id) {
        $request->validate([
            'college_name' => ['required', 'string', 'max:255'],
            'abbrev_college_name' => ['required', 'string', 'max:255'],
            'mascot_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255']
        ]);

        $team = Team::query()->find($id);

        if($team->division->conference->dynasty->user_id != auth()->user()->id)
            return;

        $team->update([
            'college_name' => $request->college_name,
            'abbrev_college_name' => $request->abbrev_college_name,
            'mascot_name' => $request->mascot_name,
            'location' => $request->location
        ]);
    }
}
