<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class Client_contr extends Controller
{
    public function index()
    {
        return view('home'); // Ensure you have a view at resources/views/client/home.blade.php
    }

    public function indexShowAll()
    {
        $clients = Client::all(); // or paginate, etc.
        return view('clients.index', compact('clients'));
    }
}
