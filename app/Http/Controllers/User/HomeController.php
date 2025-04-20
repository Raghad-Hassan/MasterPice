<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnualConference;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $conferences = AnnualConference::where('active', true)
    //                                  ->orderBy('date', 'desc')
    //                                  ->get();
        
    //     return view('conferences.show', compact('conferences'));
    
    // }

    public function index()
    {
        $conference = AnnualConference::where('active', true)
                                    ->orderBy('date', 'desc')
                                    ->first(); // بدلاً من get()
        
        return view('index', compact('conference'));
    }}
