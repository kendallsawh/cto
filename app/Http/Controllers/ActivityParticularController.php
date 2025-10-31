<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityParticular;

class ActivityParticularController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:activity_particulars,id',
            'particulars' => 'required|string',
            'particulars_cost' => 'required|numeric|min:0',
        ]);

        // Find the activity particular and update its data
        $activityParticular = ActivityParticular::findOrFail($request->id);
        $activityParticular->particulars = $request->particulars;
        $activityParticular->particulars_cost = $request->particulars_cost;
        $activityParticular->save();

        return redirect()->back()->with('success', 'Activity Particular updated successfully.');
    }
}
