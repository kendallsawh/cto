<?php

namespace App\Http\Controllers;
use App\Models\Tutorial;
use App\Models\TutorialProgress;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    /**
     * Fetch tutorial steps based on the provided tutorial name.
     */
    public function getTutorialSteps($tutorialName)
    {
        $steps = Tutorial::where('tutorial_name', $tutorialName)
                         ->orderBy('id')
                         ->get();

        return response()->json($steps);
    }

    /**
     * Mark a tutorial as complete for the authenticated user.
     */
    public function markTutorialComplete(Request $request)
    {
        $validatedData = $request->validate([
            'tutorial_name' => 'required|string',
        ]);

        $user = $request->user();

        // Prevent duplicate progress entries.
        $existingProgress = TutorialProgress::where('user_id', $user->id)
                                              ->where('tutorial_name', $validatedData['tutorial_name'])
                                              ->first();

        if (!$existingProgress) {
            TutorialProgress::create([
                'user_id'       => $user->id,
                'tutorial_name' => $validatedData['tutorial_name'],
            ]);
        }

        return response()->json(['status' => 'Tutorial marked as complete']);
    }

    /*======================================================================
     *                       Admin CRUD FUNCTIONS
     *======================================================================*/

    /**
     * Display a listing of tutorial steps.
     */
    public function index()
    {
        // Retrieve all tutorial steps ordered by tutorial name and then by id.
        $tutorials = Tutorial::orderBy('tutorial_name')->orderBy('id')->get();
        return view('admin.tutorials.index', compact('tutorials'));
    }

    /**
     * Show the form for creating a new tutorial step.
     */
    public function create()
    {
        return view('admin.tutorials.create');
    }

    /**
     * Store a newly created tutorial step in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tutorial_name' => 'required|string',
            'selector'      => 'required|string',
            'text'          => 'required|string',
        ]);

        Tutorial::create($request->only('tutorial_name', 'selector', 'text'));

        return redirect()->route('admin.tutorials.index')
                         ->with('success', 'Tutorial step created successfully.');
    }

    /**
     * Show the form for editing the specified tutorial step.
     */
    public function edit($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        return view('admin.tutorials.edit', compact('tutorial'));
    }

    /**
     * Update the specified tutorial step in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tutorial_name' => 'required|string',
            'selector'      => 'required|string',
            'text'          => 'required|string',
        ]);

        $tutorial = Tutorial::findOrFail($id);
        $tutorial->update($request->only('tutorial_name', 'selector', 'text'));

        return redirect()->route('admin.tutorials.index')
                         ->with('success', 'Tutorial step updated successfully.');
    }

    /**
     * Remove the specified tutorial step from storage.
     */
    public function destroy($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $tutorial->delete();

        return redirect()->route('admin.tutorials.index')
                         ->with('success', 'Tutorial step deleted successfully.');
    }

    /*======================================================================
     *                 Tutorial Progress Reset FUNCTIONS
     *======================================================================*/

    /**
     * Show the form for resetting tutorial progress for a specific tutorial.
     */
    public function showResetProgressForm()
    {
        // Get distinct tutorial names from the tutorials table.
        $tutorialNames = Tutorial::select('tutorial_name')
                                 ->distinct()
                                 ->get()
                                 ->pluck('tutorial_name')
                                 ->toArray();

        return view('admin.tutorials.reset-progress', compact('tutorialNames'));
    }

    /**
     * Reset (delete) tutorial progress for a specific tutorial for all users.
     */
    public function resetProgress(Request $request)
    {
        $request->validate([
            'tutorial_name' => 'required|string',
        ]);

        // Delete all progress entries for the selected tutorial.
        TutorialProgress::where('tutorial_name', $request->tutorial_name)->delete();

        return redirect()->back()
                         ->with('success', 'Tutorial progress has been reset for ' . $request->tutorial_name . '.');
    }
}
