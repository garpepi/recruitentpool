<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;


class CVDocGeneratorController extends Controller
{
    //

    public function index() {
        // $candidate = Candidate::findOrFail(1);

        // return view('CVTemplate.adidatadoc', ['candidate' => $candidate]);
        echo "Doc";
    }

    public function show($candidateId) {
        $candidate = Candidate::findOrFail($candidateId);
        return view('CVTemplate.adidatadoc', ['candidate' => $candidate]);
    }

    public function showBi($candidateId) {
        $candidate = Candidate::findOrFail($candidateId);
        return view('CVTemplate.bidoc', ['candidate' => $candidate]);
    }
}
