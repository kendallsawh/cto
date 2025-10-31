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
use App\Models\DocGroup;
use App\Models\Group;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Log;
use App\Events\PushNotificationEvent;

class PsipController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display the MOF listing.
     *
     * @return \Illuminate\View\View
     */
    /*
     This is a Laravel controller method named moflisting that:

     Retrieves a collection of Item models, including their related subitems, groups, and psipNames using Eloquent's eager loading.
     Passes the retrieved data to a view named mof-listing using the compact function to create a variable named $items in the view.
     In other words, this method fetches data from the database and renders a view to display the Ministry of Finance (MOF) listing.
    */
    public function index()
    {
        // Fetch the data with relationships and order by the specified fields
        $items = Item::with([
            'subitems' => function ($query) {
                $query->orderBy('id'); // Order subitems by their ID
            },
            'subitems.groups' => function ($query) {
                $query->orderBy('id'); // Order groups by their ID
            },
            'subitems.groups.psipNames' => function ($query) {
                $query->orderBy('code'); // Order psipNames by their code
            }
        ])->orderBy('id') // Order items by their ID
        ->get();

        $data = [
            'items' => $items,
            'financial_year' => FinancialYear::first()->year,
        ];

        // Pass the data to the view
        return view('home.mof-listing', $data);
    }
    public function prev_yrs()
    {
        return view('home.prvyrs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(

                        'divisions' => Division::orderBy('division_name')->get(),
                        'groups'=> Group::all(),
                    );


        return view('options.add_psip',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); // BEGIN THE PROCESS
        try {
            $psip = new PsipName;
            $psip->code = strtoupper($request->input('psip_code'));
            $psip->psip_name = $request->input('psip_name');
            $psip->groups_id = $request->input('group'); // fixed to match table definition
            $psip->division_id = $request->input('division');
            $psip->status_id = 1; // Setting default value to 1
        $psip->created_by = Auth::id(); // Get the ID of the currently logged-in user
            $psip->save();

            $psip_details = new PsipDetail;
            $psip_details->psip_name_id = $psip->id;
            $psip_details->psip_date = Carbon::parse($request->input('start_date'))->format('Y-m-d');
            $psip_details->details = $request->input('description');
            $psip_details->financial_year = FinancialYear::first()->year;
            $psip_details->created_by = Auth::id();
            $psip_details->save();

            $psip_financial = new PsipFinancial;
            $psip_financial->psip_details_id = $psip_details->id; // Linking to `psip_details`
            $psip_financial->approved_estimates = $request->input('allocation'); // fixed typo
            $psip_financial->financial_year = FinancialYear::first()->year;
            $psip_financial->created_by = Auth::id(); // Get the ID of the currently logged-in user
            $psip_financial->save();

            DB::commit();

            $data = array('divisions' => Division::orderBy('division_name', 'asc')->paginate(25), 'financial_year' => FinancialYear::first()->year);
            return view('home.index', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Error creating PSIP. Please try again.')
                        ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PsipName  $psip
     * @return \Illuminate\Http\Response
     */
    public function show(PsipName $psip)
    {

        //return $psip->PsipDetailForPreviousYear->id;
        //return $psip->achievementReports;
        // Get the current financial year
        $financial_year = FinancialYear::first()->year ?? now()->year;

        //Get the previous financial year and the financial year of two year prior
        $previousYear = $financial_year- 1;
        $twoYearsPrior = $financial_year - 2;

        // Get all the activities for this PSIP, for the current financial year
        $activities = $psip->activities()
            ->where('financial_year', $financial_year)
            ->orderBy('activity_order', 'ASC')
            ->get();

        // Get the PSIP Detail for the current financial year
        $psipdetails = $psip->psipDetailForCurrentYear;
        // Check if psipdetails exist before accessing financial data
        $psipFinancials = $psipdetails
        ? $psipdetails->psipFinancialsThisYear()->where('financial_year', $financial_year)->first()
        : null;
        // Get the draft estimates, approved estimates, actual expenditure and revised estimates for the current financial year
        // If the PSIP Detail does not exist for the current financial year, return an empty array
        $draft_estimates = $psipFinancials
        ? json_encode($psipFinancials->draft_estimates)
        : json_encode([]);

        $approved_estimates = $psipFinancials
            ? json_encode($psipFinancials->approved_estimates)
            : json_encode([]);

        $actual_expenditure = $psipFinancials
            ? json_encode($psipFinancials->actual_expenditure)
            : json_encode([]);

        $revised_estimates = $psipFinancials
            ? json_encode($psipFinancials->revised_estimates)
            : json_encode([]);

        // Create the data array
        $data = [

            'title' => $psip->psip_name.' - '.$psip->code,
            'activities' => $activities,
            'psipid' => $psip->id,
            'dtds' => DocTypeDivision::where('psip_id', $psip->id)->get(),
            'psip' => $psip,
            'divisions' => Division::orderBy('division_name')->get(),
            'doctypes' => DocType::all(),
            'financial_year' => $financial_year,
            'previousYear'  => $previousYear,
            'twoYearsPrior' => $twoYearsPrior,
            'draft_estimates' => $draft_estimates,
            'approved_estimates' => $approved_estimates,
            'actual_expenditure' => $actual_expenditure,
            'revised_estimates' => $revised_estimates,
            'canManagePsip' => $this->canManagePsip(Auth::user(), $psip),
            'docGroups' => DocGroup::all(),
            'current_expenditure_dt' => $psipFinancials ? $psipFinancials->current_expenditure_dt : null,
           'psip_details_id'=>$psip->PsipDetailForPreviousYear? $psip->PsipDetailForPreviousYear->id:null,
           'psip_details_idtwoyear'=>$psip->getPsipDetailForTwoYearsPriorAttribute()? $psip->getPsipDetailForTwoYearsPriorAttribute()->id:null
        ];

        // Return the view
        return view('psip.show', $data);
    }

    /**
     * Determine if the given user can manage the given PSIP.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PsipName  $psip
     * @return bool
     */
    /*
        This code snippet is a private method in a PHP class. It determines if a given user can manage a specific PSIP (Project Support Information System). It takes two parameters: $user, which is an instance of the User model, and $psip, which is an instance of the PsipName model.

        The method checks three conditions to determine if the user can manage the PSIP:

        $is_same_division checks if the user's divisions_id matches the PSIP's division_id.
        $is_admin_or_planning checks if the user is either an admin (is_admin) or a planning user (is_planning_user).
        $is_planning_division checks if the user's divisions_id matches a specific value (15).
        The method returns true if any of these conditions are met, indicating that the user can manage the PSIP. Otherwise, it returns false.
    */
    private function canManagePsip($user, $psip)
    {
        $is_same_division = $user->divisions_id == $psip->division_id;
        $is_admin_or_planning = $user->is_admin || $user->is_planning_user;
        $is_planning_division = $user->divisions_id == 15;

        return $is_same_division || $is_admin_or_planning || $is_planning_division;
    }

    public function edit($id)
    {
        $psip = PsipName::with([
            'psipDetailForCurrentYear',
            'psipDetailForCurrentYear.psipFinancials',
            'activitiesForCurrentYear',
            'activitiesForCurrentYear.activityParticulars'
        ])->find($id);

        if (!$psip) {
            // Handle the case where the record does not exist
            return redirect()->route('psip.index')->withErrors('Record not found.');
        }

        return view('psipedit.edit', compact('psip'));
    }


    public function update(Request $request, $id)
    {
        // Find the PsipName by ID
        //return dd($request->all());
        $psip = PsipName::findOrFail($id);

        $loggedInUserId = auth()->id();  // Get the logged-in user's ID

        // Update PSIP Name
        $psip->psip_name = $request->psip_name;
        $psip->updated_by = $loggedInUserId;
        $psip->save();

        // Update PsipDetailForCurrentYear
        $psip->psipDetailForCurrentYear->update([
            'details' => trim($request->input('details')),
        ]);

        // Update Financials
        $actualExpenditures = $request->input('actual_expenditure');
        $approvedEstimates = $request->input('approved_estimates');
        $revisedEstimates = $request->input('revised_estimates');

        foreach ($psip->psipDetailForCurrentYear->psipFinancials as $index => $financial) {
            $financial->update([
                'actual_expenditure' => $actualExpenditures[$index] ?? null,
                'approved_estimates' => $approvedEstimates[$index] ?? null,
                'revised_estimates' => $revisedEstimates[$index] ?? null,
            ]);
        }





        // Update Activities
        $activityNames = $request->input('activity_name');
        $particulars = $request->input('particulars');
        $particularsCost = $request->input('particulars_cost');

        foreach ($psip->activities as $index => $activity) {
            $activity->update([
                'activity_name' => $activityNames[$index] ?? null,
                'updated_by' => $loggedInUserId,
            ]);

            foreach ($activity->activityParticulars as $pIndex => $particular) {
                $particular->update([
                    'particulars' => $particulars[$pIndex] ?? null,
                    'particulars_cost' => $particularsCost[$pIndex] ?? null,
                    'updated_by' => $loggedInUserId,
                ]);
            }
        }

        return redirect()->route('psip.show',$psip->id)->with('success', 'PSIP updated successfully');
    }
    public function updatePsipDetail(Request $request,PsipName $psip)
    {

        $trimmedDetail = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $request->input('psip_detail'));
        $psip->psipDetailForCurrentYear->update([
            'details' => $trimmedDetail,
        ]);

        return redirect()->route('psip.show', $psip->id);
    }

    public function updateApproved(Request $request,PsipName $psip)
    {
        $psipdetail = $psip->psipDetailForCurrentYear->psipFinancialsLatest();
        $psipdetail->approved_estimates = $request->input('approved_estimates');
        $psipdetail->save();
        return redirect()->route('psip.show', $psip->id);
    }

    public function updateRevised(Request $request,PsipName $psip)
    {
        $psipdetail = $psip->psipDetailForCurrentYear->psipFinancialsLatest();
        $psipdetail->revised_estimates =$request->input('revised_estimates');
        $psipdetail->save();
        return redirect()->route('psip.show', $psip->id);
    }

     public function updateCurrentExpenditure(Request $request,PsipName $psip)
    {
        $psipdetail = $psip->psipDetailForCurrentYear->psipFinancialsLatest();
        $psipdetail->current_expenditure = $request->input('current_expenditure');
        $psipdetail->current_expenditure_dt = Carbon::now()->toDateString();
        $psipdetail->save();
        return redirect()->route('psip.show', $psip->id);
    }

    public function surpressPsip(Request $request,PsipName $psip)
    {
        $psip->status_id = 3;
        $psip->cancelled_by = auth()->id();
        $psip->save();
        return redirect()->route('psip.show', $psip->id);
    }

    public function startProcess()
    {
        //return 'hight there';
        $financial_year_record = FinancialYear::first();
        //$financial_year = $financial_year_record ? $financial_year_record->year : now()->year;
        $financial_year = '2024';

        $psipDetails = PsipDetail::where('financial_year', $financial_year)->get();

        foreach ($psipDetails as $psipDetail) {
            // Fetch associated psip_draft_estimates
            $draftEstimates = PsipDraftEstimate::where('psip_details_id', $psipDetail->id)->get();

            if ($draftEstimates->isEmpty()) {
                continue;
            }

            // Find the nearest financial_year among draftEstimates
            $nearestDraftEstimate = $draftEstimates->sortBy('financial_year')->first();

            // Create new records based on nearestDraftEstimate
            // Create a new record in psip_details
            $newPsipDetail = PsipDetail::create([
                'psip_name_id' => $psipDetail->psip_name_id,
                'financial_year' => $nearestDraftEstimate->draft_est_year,
                'details' => $nearestDraftEstimate->details,
                // ... any other fields
            ]);

            // Create a new record in psip_financials
            $psipFinancial = PsipFinancial::create([
                'psip_details_id' => $newPsipDetail->id,
                'revised_estimates' => $nearestDraftEstimate->draft_est,
                'financial_year' => $psipDetail->financial_year,
                // ... any other fields
            ]);

            // Reinsert remaining records
            $remainingDraftEstimates = $draftEstimates->where('id', '!=', $nearestDraftEstimate->id);

            foreach ($remainingDraftEstimates as $remainingDraftEstimate) {
                PsipDraftEstimate::create([
                    'psip_details_id' => $newPsipDetail->id, // assuming $newPsipDetail is the newly created record
                    'details' => $remainingDraftEstimate->details,
                    'draft_est' => $remainingDraftEstimate->draft_est,
                    'draft_est_year' => $remainingDraftEstimate->draft_est_year,
                    'financial_year' => $newPsipDetail->financial_year,
                    // ... other fields
                ]);
            }
        }

        // Redirect or further processing
    }

    public function AddPastEstimate(Request $request)
    {

        $psipdetail= PsipDetail::create([
           'psip_name_id'=>$request->psipnameid,
           'financial_year'=>$request->previousyear,
           'created_by' => auth()->id()
        ]);

        Log::info($psipdetail);
        $psipdetail;


         PsipFinancial::create([
               'psip_details_id'=>$psipdetail->id,
              'financial_year'=>$request->previousyear,
              'approved_estimates'=>$request->past_estimate,
              'created_by' => auth()->id()
         ]);
        return  redirect()->back()->with('success', 'Estimate Added successfully.');
    }

    public function EditPastEstimate(Request $request)
    {
        // return $request;
        $psipf= PsipFinancial::where('psip_details_id',$request->psipupid)->update(['approved_estimates'=>$request->past_estimate]);
    //    $psipf= PsipFinancial::where('id',$request->psipupid)->update(['approved_estimates'=>$request->past_estimate]);

         return  redirect()->back()->with('success', 'Estimate updated successfully.');
    }


    public function AddPastActual(Request $request)
    {


        $psipdetail= PsipDetail::create([
           'psip_name_id'=>$request->psipnameid,
           'financial_year'=>$request->previoustwoyear,
           'created_by' => auth()->id()
        ]);




       $actual=  PsipFinancial::create([
               'psip_details_id'=>$psipdetail->id,
              'financial_year'=>$request->previoustwoyear,
              'actual_expenditure'=>$request->past_actual,
              'created_by' => auth()->id()
         ]);

        return  redirect()->back()->with('success', 'Actuals updated successfully.');

    }

    public function EditPastActual(Request $request)
    {
        // return $request;
        $psipf= PsipFinancial::where('psip_details_id',$request->psipupid)->update(['actual_expenditure'=>$request->past_actual]);
    //    $psipf= PsipFinancial::where('id',$request->psipupid)->update(['approved_estimates'=>$request->past_estimate]);

         return  redirect()->back()->with('success', 'Actuals updated successfully.');
    }



    public function AddPastRevisedEstimate(Request $request)
    {

        $psipdetail= PsipDetail::create([
           'psip_name_id'=>$request->psipnameid,
           'financial_year'=>$request->previousyear,
           'created_by' => auth()->id()
        ]);

        Log::info($psipdetail);
        $psipdetail;


         PsipFinancial::create([
               'psip_details_id'=>$psipdetail->id,
              'financial_year'=>$request->previousyear,
              'revised_estimates'=>$request->past_rev_estimate,
              'created_by' => auth()->id()
         ]);
        return  redirect()->back()->with('success', 'Revised Estimate Added successfully.');
    }

    public function EditPastRevisedEstimate(Request $request)
    {
        // return $request;
        $psipf= PsipFinancial::where('psip_details_id',$request->psipupid)->update(['revised_estimates'=>$request->past_rev_estimate]);
    //    $psipf= PsipFinancial::where('id',$request->psipupid)->update(['approved_estimates'=>$request->past_estimate]);

         return  redirect()->back()->with('success', 'Revised Estimate updated successfully.');
    }


    //------------sub activity functions 06-03-2025------------------
    public function addParticularModal($activity_id)
    {
        $activity = Activity::findOrFail($activity_id);
        return view('options.add_particular_modal', compact('activity'));
    }

    public function storeParticulars(Request $request, $activity_id)
    {
        $request->validate([
            'particulars.*' => 'required|string',
            'particulars_cost.*' => 'required|numeric|min:0',
        ]);

        foreach ($request->particulars as $index => $particular) {
            ActivityParticular::create([
                'activity_id' => $activity_id,
                'particulars' => $particular,
                'particulars_cost' => $request->particulars_cost[$index],
                'created_by' => auth()->id(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Sub-activities added successfully']);
    }


}
