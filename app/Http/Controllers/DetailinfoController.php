<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class DetailinfoController extends Controller
{
    //
    public function index($candidateId) {
        $candidate = Candidate::findOrFail($candidateId);
        return view('Detail.index', ['candidate' => $candidate]);
    }
}
