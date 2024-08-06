<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\sign_up_request;
use App\Models\Client;


class sign_up_contr extends Controller
{
    function sign_up( ){

        return view('auth.pages-sign-up');
      
          }

      
          public function do_sign_up(sign_up_request $request)
          {
              $validatedData = $request->validated();
          
              // Create a new user
              $user = User::create([
                  'name' => $validatedData['name'],
                  'email' => $validatedData['email'],
                  'password' => Hash::make($validatedData['password']),
              ]);
          
              // Create a corresponding client record
              Client::create([
                  'user_id' => $user->id,
                  'name' => $user->name,
              ]);
          
              return to_route('login')->with('success', 'Le compte est crée avec succés');
          }



}
