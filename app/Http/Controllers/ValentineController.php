<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValentineController extends Controller
{
    // Main page
    public function index()
    {
        $letter = DB::table('letters')->latest()->first();
        return view('valentine', compact('letter'));
    }

    // Yes button action
    public function showLetter()
    {
        $letter = DB::table('letters')->latest()->first();
        return view('letter', compact('letter'));
    }
}