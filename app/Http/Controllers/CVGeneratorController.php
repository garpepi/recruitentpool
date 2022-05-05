<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Illuminate\Support\Facades\View;

class CVGeneratorController extends Controller
{
    //
    public function index() {
        // ob_start();
    // echo view('CVTemplate.adidata');
    // $content = ob_get_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $view = View::make('CVTemplate.adidata');
        // $html2pdf->writeHTML($content);
        $html2pdf->writeHTML($view->render());
        // $html2pdf->writeHTML('<h1>Hello</h1> Test only');
        $html2pdf->output('CV.pdf');
    }

    public function show($candidateId) {
        $candidate = Candidate::findOrFail($candidateId);
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $view = View::make('CVTemplate.adidata', ['candidate' => $candidate]);
        $html2pdf->writeHTML($view->render());
        $html2pdf->output('CV-'.$candidate->fullname.'.pdf');
    }

    public function showBi($candidateId) {
        $candidate = Candidate::findOrFail($candidateId);
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $view = View::make('CVTemplate.bi', ['candidate' => $candidate]);
        $html2pdf->writeHTML($view->render());
        $html2pdf->output('CV-'.$candidate->fullname.'.pdf');
    }
}
