<?php

namespace App\Http\Controllers;

use App\Http\Requests\sign_up_request;
use App\Http\Requests\update_request;
use App\Models\client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class profile_contr extends Controller
{


    public function setting()
{
    if (Auth::user()->isClient()) {
        return view('settingClient');
    } elseif (Auth::user()->isAdmin()) {
        return view('setting');
    }
}







    function update(update_request $request){
        $user_id=Auth::user()->id;
        $user= User::find($user_id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');

        if(!empty($request->input('password'))){

            $user->password= Hash::make($request->input('password'))  ;
        }
        $user->save();

        return to_route('setting');
       
        
    }



    
    function information(Request $request){

        $id=Auth::user()->id;
        $client = Client::where('user_id', $id)->latest()->first();
      
            return view('client_information',compact('client'));

       
            
        

    }


    function add_update_information(Request $request)
{
    $id = Auth::user()->id;

    // Find the client associated with the current user
    $client = Client::where('user_id', $id)->first();

    if ($client) {
        // If the client exists, update the existing record
        $client->name = $request->name;
        $client->address = $request->address;
        $client->tel = $request->tel;
        $client->save();

        return to_route('information')->with('success', 'Client mis à jour avec succès.');
    } else {
        // If no client exists, create a new record
        return to_route('information')->with('error', 'Client non trouvé.');


    }
}


}
