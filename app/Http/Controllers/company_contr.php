<?php

namespace App\Http\Controllers;

use App\Models\companyinfo;
use Illuminate\Http\Request;

class company_contr extends Controller
{
    public function index()
    {
        $companies = companyinfo::all();
        return view('companies.index', compact('companies'));
    }
}
