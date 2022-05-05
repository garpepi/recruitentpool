<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipController extends Controller
{
    //
    public function downloadZip($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        $zip = new ZipArchive;
        $fileName = $candidate->fullname."_".Carbon::now()->timestamp.".zip";

        if ($zip->open(public_path($fileName), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

            foreach ($candidate->documents as $doc) {
                $file = Storage::disk('docs')->path($doc->file_name);
                $zip->addFile($file, $doc->file_name);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }
}
