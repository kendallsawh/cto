<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PsipName;
use App\Models\FinancialYear;//there is a middleware updatefinancialyear that automatically updates the year record in the database on september 30th
use App\Models\PsipDraftEstimate;
use App\Models\PsipDetail;
use App\Models\Activity;
use App\Models\ActivityParticular;

class PsipProjectionController extends Controller
{
/**
 * Show the form for creating a new PSIP projection.
 *
 * @param  \App\Models\PsipName  $psipname
 * @return \Illuminate\View\View
 * This is a PHP method named create in a controller class. It's purpose is to display a form for creating a new PSIP projection.
 * The method takes a PsipName object as a parameter, stores it in an array, and then passes this array to a view named psip.details_activities to be rendered.
 * In essence, it's a method that handles a GET request to display a form for creating a new PSIP projection, likely with the PSIP name details pre-populated.
 */
    public function create(PsipName $psipname)
    {
        //return view('psip.details_activities', compact('psipname'));
        $data = array(
                        'psip' => $psipname,
                    );
        //return view('psip.projections',$data); blade still exist but not in use 29/20/2024
        return view('psip.details_activities', $data);
    }

    public function store(Request $request, PsipName $psipname)
    {
        //return $psipname;
        // Get the ID for the current financial year's details
        $psipDetailId = $psipname->psipDetailForCurrentYear()->first()->id;

        //Get financial year
        $financial_year_record = FinancialYear::first();
        $financial_year = $financial_year_record ? $financial_year_record->year : now()->year;

        // Get other form data
        $details = trim($request->input('details'));
        $draftEst = $request->input('draft_est');
        $draftEstYear = $request->input('draft_est_year');


        // Store in psip_draft_estimates table
        $draftEstimate = new PsipDraftEstimate([
            'psip_details_id' => $psipDetailId,
            'details' => $details,
            'draft_est' => $draftEst,
            'draft_est_year' => $draftEstYear,
            'financial_year' => $financial_year,
            'created_by' => auth()->id()
        ]);
        $draftEstimate->save();
        // Get the submitted data
        $activityNames = $request->input('activity_name');
        $particulars = $request->input('particulars');
        $particularsCost = $request->input('particulars_cost');

        // Loop through each activity
        foreach ($activityNames as $index => $activityName) {

            // Create a new Activity and associate it with the current PsipName
            $activity = new Activity(['activity_name' => $activityName]);
            $activity = $psipname->activities()->save($activity);

            // Loop through each particular for the current activity
            foreach ($particulars[$index] as $j => $particular) {
                $cost = $particularsCost[$index][$j];

                // Create a new ActivityParticular and associate it with the current Activity
                $activityParticular = new ActivityParticular([
                    'activity_id' => $activity->id,
                    'particulars' => $particular,
                    'particulars_cost' => $cost,
                ]);
                $activity->activityParticulars()->save($activityParticular);
            }
        }



        // Redirect or do whatever you need to after storing the records
        return redirect()->route('psip.show',$psipname->id);
    }

}
