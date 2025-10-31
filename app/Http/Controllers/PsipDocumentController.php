<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\PsipDoc;
use App\Models\DocType;
use App\Models\PsipName;
use App\Models\Division;
use App\Models\PsipTag;
use App\Models\Activity;
use App\Models\DocTypeDivision;
use App\Models\ReplacedPsipDoc;
use App\Models\PsipScreeningBrief;
use App\Models\PsipAchievementReport;
use App\Models\PsipPsNote;
use DB;
use Illuminate\Support\Facades\Log;
use App\Events\DocumentUploadedEvent;
use App\Events\PushNotificationEvent;
use Carbon\Carbon;
use App\Models\DocGroup;
use App\Models\FinancialYear;


class PsipDocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Activity $activity)
    {


        return view('psipupload.create',[
            'activity' => $activity,
            'folder_types' => Activity::all(),
            'doc_types' => DocType::orderBy('doc_type_name','ASC')->get(),
            'doc_groups' => DocGroup::orderBy('group_name','ASC')->get()
        ]);
    }

    public function getGroupDocuments(Activity $activity)
    {
        //return ($activity->psipDocs);

        return view('options.group_documents',[
            'activity' => $activity,
            'documents' => $activity->psipDocs,
            'doc_groups' => DocGroup::orderBy('group_name','ASC')->get()
        ]);
        //return view('options.group_documents');
    }

    public function updateGroupDocuments(Request $request)
    {
        //$documentId = $request->input('documentId');
        $groupId = $request->input('groupId');

        $document = PsipDoc::find($request->input('documentId'));
        if ($document) {
            $document->update(['doc_group_id' => $groupId]);
             return response()->json(['success' => true, 'message' => 'Item moved successfully.']);
        } else {
             return response()->json(['error' => true, 'message' => 'Your attempt has failed successfully.']);
        }

        // Logic to update the item's group based on itemId and groupId
        // For example, updating the database record for the item



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        DB::beginTransaction();
        try {
            // Validate request data
            $validated = $request->validate([
                'doc_type' => 'required|exists:doc_types,id',
                'title' => 'required|string',
                'description' => 'nullable|string',
                'doc_group' => 'required|exists:doc_groups,id',
                'file_upload' => 'nullable|file',
            ]);

            // Create new PsipDoc
            $psipdoc = new PsipDoc;
            $psipdoc->activities_id = $activity->id;
            $psipdoc->doc_types_id = $validated['doc_type'];
            $psipdoc->doc_title = $validated['title'];
            $psipdoc->doc_year = FinancialYear::first()->year;
            $psipdoc->description = $validated['description'];
            $psipdoc->created_by = auth()->id();
            $psipdoc->doc_group_id = $validated['doc_group'];
            $psipdoc->save();

            // Handle file upload
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $activity_code = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $activity->id);
                $doc_name_sanitized = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', DocType::find($validated['doc_type'])->doc_type_name);
                $doc = $activity_code.'_'.$doc_name_sanitized.'_Scan_'.md5($file->getClientOriginalName().time()).'.'.$file->extension();

                $path = $file->storeAs(
                    'public/documents/'.$activity->psipName->code.'/'.$activity->folder_name.'/',
                    $doc
                );

                $psipdoc->filepath = str_replace('public/', '', $path);
                $psipdoc->file_type = $file->extension();
                $psipdoc->save();
                //event(new DocumentUploadedEvent(\Auth::user(), DocType::find($psipdoc->doc_types_id)));//this is the mail notification
                DocumentUploadedEvent::dispatch(
                    (int) $psipdoc->doc_types_id,              // 1: $doc_type_id  (int)
                    (string) $psipdoc->doc_title,              // 2: $name         (string)
                    $psipdoc->description,                     // 3: $description  (?string)
                    (int) auth()->id(),                        // 4: $uploaded_by_user_id (int)
                    route('psip.show', ['psip' => $activity->psipName->id]) // 5: $url (string)
                );
            }

            DB::commit();
            return redirect()->route('psip.show', ['psip' => $activity->psipName->id])
                ->withSuccess(__('PSIP document saved successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving PSIP document: '.$e->getMessage(), [
                'activity_id' => $activity->id,
                'request_data' => $request->all()
            ]);
            return redirect()->back()->withErrors(__('An error occurred while saving the document.'));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PsipDoc  $post
     * @return \Illuminate\Http\Response
     */
    public function show(PsipName $psip)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PsipDoc  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(PsipDoc $post)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PsipDoc  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $activity_id= $request->update_activity_doc_id;
        $document = PsipDoc::find($request->update_doc_id);
        DB::beginTransaction();//BEGIN THE PROCESS
        try{
            $psipdoc = new PsipDoc;
            $psipdoc->activities_id = $activity_id;
            $psipdoc->doc_types_id = $document->doc_types_id;
            $psipdoc->description = 'Updated document - '.$document->description;
            $psipdoc->previous_doc_id = $document->id;
            $psipdoc->created_by = auth()->id();
            //$psip = $activity->psipName->id;
            $psipdoc->doc_group_id = $request->doc_group;
            $psipdoc->save();
            $docname=trim(DocType::find($document->doc_types_id)->doc_type_name);
            /*upload and record file*/
            if (isset($request->file_upload)) {
                        sleep(2);
                    $file = $request->file_upload;
                    //$file->storeAs('public/documents', 'test');
                    if (!empty($file)) {
                        $activity_code = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $activity_id);
                        $doc_name_sanitized = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $docname);
                        $doc = $activity_code.'_'.$doc_name_sanitized.'_Scan_'.md5($file->getClientOriginalName().time()).'.'.$file->extension();

                        $file->storeAs('public/documents', $doc);


                        $psipdoc->filepath = "documents/".$doc;
                        $psipdoc->file_type = $file->extension();
                        $psipdoc->save();
                        //event(new DocumentUploadedEvent(\Auth::user(), DocType::find($psipdoc->doc_types_id)));//this is the mail notification
                        DocumentUploadedEvent::dispatch(
                            $psipdoc->doc_types_id,
                            $psipdoc->doc_title,
                            $psipdoc->description,
                            auth()->id(),
                            route('psip.show', PsipName::find($psipdoc->activities_id)->id)
                        );
                    }
                }
            /*add old entry to archive*/
            $log_old_doc = new ReplacedPsipDoc;
            $log_old_doc->filepath = $document->filepath;
            $log_old_doc->file_type = $document->file_type;
            $log_old_doc->doc_types_id = $document->doc_types_id;
            $log_old_doc->activities_id = $document->activities_id;
            $log_old_doc->description = $document->description;
            $log_old_doc->previous_doc_id = $document->previous_doc_id;
            $log_old_doc->doc_group_id = $document->doc_group_id;
            $log_old_doc->created_by = $document->created_by;
            $log_old_doc->save();
            /*soft delete original entry*/
            $document->delete();

            $activity = Activity::find($activity_id);

        DB::commit();
            return redirect()->route('psip.show',['psip' => $activity->psipName->id])//replace this and remove comment when finished
            ->withSuccess(__('PSIP document saved successfully.'));
        }
        catch (Exception $e) {
            DB::rollBack();
            Log::error(dd($e));
            Log::error($e->getMessage());//log error to log file
            //return dd($e);//replace this and remove comment when finished

        }
    }

    public function updatedetails(Request $request)
    {
        Log::info("$request->update_doc_id");
       Log::info("$request->update_activity_doc_id");
        $activity_id= $request->update_activity_doc_id;
        $document = PsipDoc::find($request->update_doc_id);
        Log::info("$activity_id");
        DB::beginTransaction();//BEGIN THE PROCESS
        try{

            $document->doc_title = $request->title;
            $document->doc_types_id = $request->doc_type;
            // $string= str_replace($request->description,'Updated document description - ');

            $document->description =  $request->description;
            //would be a good idea to save the previous details in another table.
            $document->save();


            $activity = Activity::find($activity_id);

        DB::commit();
            return redirect()->route('psip.show',['psip' => $activity->psipName->id])//replace this and remove comment when finished
            ->withSuccess(__('PSIP document saved successfully.'));
        }
        catch (Exception $e) {
            DB::rollBack();
            Log::error(dd($e));
            Log::error($e->getMessage());//log error to log file
            //return dd($e);//replace this and remove comment when finished

        }
    }

    public function addScreeningBrief(Request $request,PsipName $psip)
    {
        $document = DocType::find(6);//screening brief
        DB::beginTransaction();//BEGIN THE PROCESS
        try {
            $screeningbrief = new PsipScreeningBrief;
            $screeningbrief->psip_names_id = $psip->id;
            /*$screeningbrief->file_name = ;
            $screeningbrief->details = ;*/
            //$screeningbrief->previous_note_id = ;

            $docname=trim($document->doc_type_name);
            /*upload and record file*/
            if (isset($request->file_upload)) {
                        sleep(2);
                    $file = $request->file_upload;

                    if (!empty($file)) {

                        $doc_name_sanitized = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $docname);
                        $doc = $doc_name_sanitized.'_'.time().'.'.$file->extension();
                        $file->storeAs('public/documents/screeningbrief', $doc);
                        $path = $file->storeAs(
                            'public/documents/'.$psip->code.'/screeningbrief/',
                            $doc
                        );

                        $screeningbrief->filepath = str_replace('public/', '', $path);
                        $screeningbrief->file_type = $file->extension();
                        $screeningbrief->save();
                        event(new DocumentUploadedEvent(\Auth::user(), $document));//this is the mail notification
                    }
                }
            DB::commit();
            return redirect()->route('psip.show',['psip' => $psip->id])//replace this and remove comment when finished
            ->withSuccess(__('PSIP document saved successfully.'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(dd($e));
            //return dd($e);//replace this and remove comment when finished
        }
    }

    public function addPSNote(Request $request,PsipName $psip)
    {
        $document = DocType::find(2);// psnote
        DB::beginTransaction();//BEGIN THE PROCESS
        try {
            $psnote = new PsipPsNote;
            $psnote->psip_names_id = $psip->id;
            /*$psnote->file_name = ;
            $psnote->details = ;*/
            //$psnote->previous_note_id = ;

            $docname=trim($document->doc_type_name);
            /*upload and record file*/
            if (isset($request->file_upload)) {
                        sleep(2);
                    $file = $request->file_upload;

                    if (!empty($file)) {

                        $doc_name_sanitized = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $docname);
                        $doc = $doc_name_sanitized.'_'.time().'.'.$file->extension();

                        $path = $file->storeAs(
                            'public/documents/'.$psip->code.'/psnote/',
                            $doc
                        );

                        $psnote->filepath = str_replace('public/', '', $path);
                        $psnote->file_type = $file->extension();
                        $psnote->save();
                        event(new DocumentUploadedEvent(\Auth::user(), $document));//this is the mail notification
                    }
                }
            DB::commit();
            return redirect()->route('psip.show',['psip' => $psip->id])//replace this and remove comment when finished
            ->withSuccess(__('PSIP document saved successfully.'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(dd($e));
            //return dd($e);//replace this and remove comment when finished
        }
    }

    public function addAchievementReport(Request $request,PsipName $psip)
    {
        $document = DocType::find(35);//screening brief
        DB::beginTransaction();//BEGIN THE PROCESS
        try {
            $achievementReport = new PsipAchievementReport;
            $achievementReport->psip_names_id = $psip->id;
            $achievementReport->file_name = $request->title;
            $achievementReport->details = $request->description;
            $achievementReport->achievement_date = Carbon::parse($request->report_date)->format('Y-m-d');
            $achievementReport->created_by = \Auth::user()->id;
            //$screeningbrief->previous_note_id = ;

            $docname=trim($document->doc_type_name);
            /*upload and record file*/
            if (isset($request->file_upload)) {
                        sleep(2);
                    $file = $request->file_upload;

                    if (!empty($file)) {

                        $doc_name_sanitized = preg_replace('/[\/\s\\\\,.:;\'"!?]+/', '_', $docname);
                        $doc = $doc_name_sanitized.'_'.time().'.'.$file->extension();

                        $path = $file->storeAs(
                            'public/documents/'.$psip->code.'/achievement_report/',
                            $doc
                        );

                        $achievementReport->filepath = str_replace('public/', '', $path);
                        $achievementReport->file_type = $file->extension();
                        $achievementReport->save();
                        event(new DocumentUploadedEvent(\Auth::user(), $document));//this is the mail notification
                    }
                }
            DB::commit();
            return redirect()->route('psip.show',['psip' => $psip->id])//replace this and remove comment when finished
            ->withSuccess(__('PSIP document saved successfully.'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(dd($e));
            //return dd($e);//replace this and remove comment when finished
        }
    }

    public function assign()
    {
        $divisions = Division::all();
        $doctypes = DocType::all();
        return view('options.assign_doc', compact('divisions', 'doctypes'));
    }

    public function store_assign(Request $request)
    {
        //return dd($request->all());
        // Validate the request
        $request->validate([
            'division' => 'required',
            'psip' => 'required',
            'activity' => 'required',
            'doctype' => 'required',
        ]);


        // Create a new record in the DocTypeDivision model
        DocTypeDivision::create([
            'document_id' => $request->doctype,
            'division_id' => $request->division,
            'psip_id' => $request->psip,
            'activity_id' =>$request->activity,
        ]);

        // Redirect to the named route with the PSIP ID
        return redirect()->route('psip.show', ['psip' => $request->psip]);
    }

    public function store_assign_2(Request $request)
    {
        // Validate the request
        $request->validate([
            'division' => 'required',
            'activity' => 'required',
            'doctype' => 'required',
        ]);

        // Create a new record in the DocTypeDivision model
        DocTypeDivision::create([
            'document_id' => $request->doctype,
            'division_id' => $request->division,
            'psip_id' => $request->psip,
            'activity_id' =>$request->activity,
        ]);

        // Redirect to the named route with the PSIP ID
        return redirect()->route('psip.show', ['psip' => $request->psip]);
    }

    public function getPsips(Division $division)
    {
        $psips = $division->psipNames; // Assuming a one-to-many relationship
        return response()->json($psips);
    }

    public function getActivities(PsipName $psip)
    {
        $activities = $psip->activities; // Assuming a one-to-many relationship
        return response()->json($activities);
    }

    public function searchDocTypeDivision(Request $request)
    {
        $activity_id = $request->input('activity_id');
        $results = DocType::all();

        //return $results;
        if ($results->isEmpty()) {
            return response()->json(['status' => 'not_found']);
        }

        $output = [];
        foreach ($results as $result) {
            $search = PsipDoc::where('doc_types_id','=',$result->id)->where('activities_id','=',$activity_id)->first();
            $output[] = [

                'doc_type_name' => $result->doc_type_name,
                'uploaded'=> is_null($search)?'No':'Yes'
            ];
        }

        return response()->json(['status' => 'found', 'data' => $output]);
    }
    /**
     * Display the form to add a new document type for the given activity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function showdoctype(Request $request, Activity $activity)
    {
        //return $activity;
        $data = [
            'activity' => $activity,
        ];

       return view('psipupload.add_doctype',$data);

    }

    public function adddoctype(Request $request)//not using Activity $activity. please remove
    {

        $doctype = new DocType;
        $doctype->doc_type_name = $request->doc_name;
        $activity = $request->activity;
        $doctype->save();

        return redirect('psipupload/create/'.$activity)
        ->withSuccess(__('PSIP document saved successfully.'));

    }


}
