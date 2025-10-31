<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use HttpFoundation\Response;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use App\Models\Division;
use App\Models\FinancialYear;
use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        $data = array('divisions' => Division::orderBy('division_name','asc')->paginate(25), 'financial_year'=>FinancialYear::first()->year, 'tutorialName' => 'index-page-dataentry');

        return view('home.index',$data);
    }


    /**
     * Display the MOF listing.
     *
     * @return \Illuminate\View\View
     */
    /* This is a Laravel controller method named moflisting that:

    Retrieves a collection of Item models, including their related subitems, groups, and psipNames using Eloquent's eager loading.
    Passes the retrieved data to a view named mof-listing using the compact function to create a variable named $items in the view.
    In other words, this method fetches data from the database and renders a view to display the Ministry of Finance (MOF) listing. */
    public function moflisting()
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

    // Retrieve the current financial year from the FinancialYear model
    $currentYear = FinancialYear::first()->year;
    $previousYear = $currentYear - 1;
    $twoYearsPrior = $currentYear - 2;

    $data = [
        'items'         => $items,
        'financial_year'=> $currentYear,
        'previousYear'  => $previousYear,
        'twoYearsPrior' => $twoYearsPrior,
    ];

    // Pass the data to the view
    return view('home.mof-listing', $data);
}



    public function test()
    {


        return view('options.group_documents');
    }


}
