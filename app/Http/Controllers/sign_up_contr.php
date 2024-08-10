<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\sign_up_request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;


class sign_up_contr extends Controller
{
    function sign_up( ){

        $user = Auth::user();

        if ($user && $user->usertype == 'admin') {
            // Si l'utilisateur est un admin
            return view('auth.pages-sign-up');
        } else {
            // Si l'utilisateur est un user ou non connecté
            return view('auth.pages-sign-up-user');
        }
      
    }

      
          public function do_sign_up(sign_up_request $request)
          {
              $validatedData = $request->validated();
          
              // Create a new user
              $user = User::create([
                  'name' => $validatedData['name'],
                  'email' => $validatedData['email'],
                  'password' => Hash::make($validatedData['password']),
                  'usertype' => $validatedData['usertype'],
                  'uservalid' => $validatedData['uservalid'],
              ]);
          
              // Create a corresponding client record
              Client::create([
                  'user_id' => $user->id,
                  'name' => $user->name,
              ]);
          
              return to_route('dashboard')->with('success', 'Le compte est crée avec succés');
          }

          public function do_sign_up_user(sign_up_request $request)
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
                  'adress' => $user->adress,
                  'tel' => $user->tel,
              ]);
          
              return to_route('login')->with('success', 'Le compte est crée avec succés');
          }

}
