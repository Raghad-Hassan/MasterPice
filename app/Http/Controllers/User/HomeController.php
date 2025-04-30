<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnualConference;

class HomeController extends Controller
{
   

    public function index()
    {
        $conferences = AnnualConference::where('status', 'active')
                                    ->orderBy('date', 'desc')
                                    ->get(); 
        // dd($conferences);
        return view('index', compact('conferences'));
    }}

