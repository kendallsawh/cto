<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use HttpFoundation\Response;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Models\PsipName;
use App\Models\Division;
use App\Models\FinancialYear;//there is a middleware updatefinancialyear that automatically updates the year record in the database on september 30th
use App\Models\PsipDetail;
use App\Models\PsipFinancial;
use App\Models\Activity;
use App\Models\ActivityParticular;
use App\Models\DocTypeDivision;
use App\Models\DocType;
use App\Models\PsipDraftEstimate;
use App\Models\Group;
use Carbon\Carbon;


class DataEntryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $divisions = Division::all();
        $groups = Group::all();
        $psip = PsipName::findOrFail($id);

        return view('dataentry.dataentry', compact('divisions', 'groups', 'psip'));
    }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\PsipName  $psip
         * @return \Illuminate\Http\Response
         */
        /**
         * Validation rules:
         * - financial_year: required|integer|min:2025|max:2099|digits:4
         * - description: required|string
         * - actual_expenditure: required|integer|min:0
         * - approved_allocation: required|integer|min:0
         * - revised_allocation: required|integer|min:0
         * - current_allocation: required|integer|min:0
         * - activity_name.*: required|string
         * - particulars.*.*: required|string
         * - particulars_cost.*.*: required|integer|min:0
         */

         /**
            * Here's a succinct explanation:
            *It attempts to store data in three tables: psip_details, psip_draft_estimates,
            *and activities (with associated activity_particulars).
            *It retrieves input data from the request, including financial year, description,
            *activity names, particulars, and costs.
            *It creates a new PsipDetail and PsipFinancial record, and then loops through each
            *activity to create a new Activity record with associated ActivityParticular records.
            *If any errors occur during this process, it logs the error and redirects the user
            *with an error message. Otherwise, it redirects the user to the home.index route.
        **/
public function store(Request $request, PsipName $psip)
    {
        try {
            // Store in psip_details table
            $psipdetail = PsipDetail::create([
                'psip_name_id' => $psip->id,
                'financial_year' => $request->input('financial_year'),
                'details' => $request->input('description'),
            ]);

            // Store in psip_draft_estimates table
            $psipfinancial = PsipFinancial::create([
                'psip_details_id' => $psipdetail->id,
                'actual_expenditure' => $request->input('actual_expenditure'),
                'approved_estimates' => $request->input('approved_allocation'),
                'revised_estimates' => $request->input('revised_allocation'),
                'current_expenditure' => $request->input('current_allocation'),
                'financial_year' => $request->input('financial_year'),
                'created_by' => auth()->id(),
            ]);

            // Get the submitted data
            $activityNames = $request->input('activity_name', []);
            $particulars = $request->input('particulars', []);
            $particularsCost = $request->input('particulars_cost', []);

            // Loop through each activity
            foreach ($activityNames as $index => $activityName) {
                $activity = $psip->activities()->create([
                    'activity_name' => $activityName,
                    'financial_year' => $request->input('financial_year'),
                    'status_id' => 1,
                ]);

                // Ensure particulars and particularsCost exist for this index
                if (!empty($particulars[$index]) && !empty($particularsCost[$index])) {
                    foreach ($particulars[$index] as $j => $particular) {
                        $cost = $particularsCost[$index][$j] ?? 0; // Default cost to 0 if not set

                        $activity->activityParticulars()->create([
                            'particulars' => $particular,
                            'particulars_cost' => $cost,
                        ]);
                    }
                }
            }

            return redirect()->route('home.index');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error storing PSIP data: ' . $e->getMessage(), [
                'trace' => $e->getTrace()
            ]);

            return redirect('/')->with('error', 'An error occurred while saving data. Please try again.');
        }
    }

}
