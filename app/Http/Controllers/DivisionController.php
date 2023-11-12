<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    // Create a division
    public function store(Request $request, int $conferenceId) {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $conference = Conference::query()->find($conferenceId);

        if($conference->dynasty->user_id != auth()->user()->id)
            return;

        $conference->divisions()->create([
            'name' => $request->name
        ]);
    }
}
