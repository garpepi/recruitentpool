<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Models\Candidate;
use App\Models\Family;

class WebhooksController extends Controller
{
    //
    public function index() {
        echo 'nothing to see here';
    }

    public function list() {
        foreach(Storage::disk('hookers')->allFiles() as $file){
            echo '<a href = http://localhost/storage/hookers/'.$file.'>'.$file.'</a><br>' ;
        }
    }
    public function store(Request $request) {
        // backup the return
        $filename = Carbon::now()->timestamp;
        try{
            Storage::disk('hookers')->put($filename.'.json', $request->getContent());
        }catch(Error $e){
            return response()->json(['message' => 'error on save backup'], 500);
        }

        echo 'start';
        // Input data
        $content = json_decode($request->getContent());
        try{
            DB::beginTransaction();
            
            // Candidate
            $personalData = $content->PERSONALDATA;
            $candidate = Candidate::create([
                'link_bkp' => $filename.'.json',
                'fullname' => $personalData->Fullname,
                'email' => $personalData->Email,
                'id_number' => $personalData->IDNumber,
                'tax_number' => $personalData->TaxNumber,
                'home_address' => $personalData->HomeAddress->FullInternationalAddress,
                'home_phone' => $personalData->HomePhone,
                'mobile_phone' => $personalData->MobilePhone,
                'date_of_birth' => $personalData->DateOfBirth,
                'place_of_birth' => $personalData->PlaceOfBirth,
                'religion' => $personalData->Religion,
                'gender' => $personalData->Gender,
                'freshgraduate' => $this->isNo($personalData->Freshgraduate),
                'blood_type' => $personalData->BloodType,
                'citizenship' => $personalData->Citizenship,
                'marital_status' => $content->FAMILYDATA->MaritalStatus,
                'mariage_year' => $content->FAMILYDATA->MarriageYear
            ]);

            // Emergency Contact
            $emergency_contact = $content->PERSONALDATA->EmergencySituation;
            $candidate->emergencyContact()->create(
                [
                    'name' => $emergency_contact->ContactName,
                    'relation' => $emergency_contact->Relationship,
                    'number' => $emergency_contact->ContactNumber
                ]
            );

            // Family
            $families = [];
            foreach($content->FAMILYDATA->Family as $family) {
                $families[] = new Family([
                    'name' => $family->Name,
                    'status' => $family->Status,
                    'gender' => $family->Gender,
                    'occupation' => $family->Occupation,
                    'education' => $family->Education
                ]);
            }

            foreach($content->FAMILYDATA->CloseFamilyInformation as $family) {
                $families[] = new Family([
                    'name' => $family->Name,
                    'status' => $family->Status,
                    'gender' => $family->Gender,
                    'occupation' => $family->Occupation,
                    'education' => $family->Education
                ]);
            }
            $candidate->families()->saveMany($families);

            DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
        
        echo 'success';
    }

    private function isNo($string) {
        if($string == 'No' || $string == 'NO' || $string == 'no') {
            return 0;
        } else {
            return 1;
        }
    }
}
