<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class DashboardController extends Controller
{
    //
    public function index() {
        return view('dashboard.index', ['candidates' => Candidate::all()]);
    }
}
