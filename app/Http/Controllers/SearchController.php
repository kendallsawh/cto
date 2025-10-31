<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PsipName;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        // Query the PsipName model for results that match the search term.
        $results = PsipName::where('psip_name', 'LIKE', "%{$query}%")
            ->orWhere('code', 'LIKE', "%{$query}%")
            ->take(10)
            ->get();

        // Prepare the result for AJAX response.
        $response = $results->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->psip_name,
                'code' => $item->code,
                'link' => route('psip.show', ['psip' => $item->id])
            ];
        });

        return response()->json($response);
    }
}

