<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class DetailinfoController extends Controller
{
    //
    public function index($candidateId) {
        return view('Detail.index');
    }
}
