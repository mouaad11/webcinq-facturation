<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\client;
use App\Models\companyinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisContr extends Controller
{
    function devis_form_admin(){
       
        $latestClientsData=client::select('user_id', DB::raw('MAX(created_at) as latest_created_at'))
                    ->groupby('user_id')->get();
    
        $userIds = $latestClientsData->pluck('user_id');
        $latestCreatedAts = $latestClientsData->pluck('latest_created_at');

        $client = Client::whereIn('user_id', $userIds)
                       ->whereIn('created_at', $latestCreatedAts)
                       ->get();

        $companyinfo=companyinfo::all();
        return view('devis_form_admin',compact('client','companyinfo'));
    }
}
