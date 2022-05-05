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
use App\Models\FormalEducation;
use App\Models\NonFormalEducation;
use App\Models\LanguageProficiencies;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Organization;
use App\Models\Refference;
use App\Models\WorkingExperience;
use App\Models\WorkingProject;
use App\Models\Documents;
use App\Models\Logs;

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

            // Formal Education
            $formalEdu = [];
            foreach($content->Educations->FormalEducation as $education) {
                $formalEdu[] = new FormalEducation([
                    'institution' => $education->InstitutionName,
                    'grades' => $education->Grades,
                    'city' => $education->City,
                    'start' => $education->Start,
                    'graduates' => $education->Graduates,
                    'gpa' => $education->GPA
                ]);
            }
            $candidate->formalEducation()->saveMany($formalEdu);

            // Non-Formal Education
            $nonFormalEdu = [];
            foreach($content->Educations->NonformalEducation as $education) {
                $nonFormalEdu[] = new NonFormalEducation([
                    'course_name' => $education->CourseName,
                    'year' => $education->Year,
                    'duration' => $education->Duration,
                    'certificate' => $education->Certificate
                ]);
            }
            $candidate->nonFormalEducation()->saveMany($nonFormalEdu);

            // Language Proficiencies
            $languages = [];
            foreach($content->SkillsProficiencies->LanguageProficiencies as $language) {
                $languages[] = new LanguageProficiencies([
                    'language' => $language->Language,
                    'written' => $language->Written,
                    'speaking' => $language->Speaking,
                    'reading' => $language->Reading
                ]);
            }
            $candidate->languages()->saveMany($languages);

            // Skills
            $skills = [];
            foreach($content->Skills as $skill) {
                $skills[] = new Skill([
                    'skill' => $skill->Skill,
                    'proficiency_level' => $skill->ProficiencyLevel
                ]);
            }
            $candidate->skills()->saveMany($skills);

            // Certificate
            $certificates = [];
            foreach($content->Certificates as $certificate) {
                $certificates[] = new Certificate([
                    'name' => $certificate->CertificateName,
                    'issuer' => $certificate->Issuer,
                    'year' => $certificate->Year,
                    'expired_date' => $certificate->ExpiredDate
                ]);
            }
            $candidate->certificates()->saveMany($certificates);

            // Organization
            $organizations = [];
            foreach($content->Organizations as $org) {
                $organizations[] = new Organization([
                    'name' => $org->OrganizationName,
                    'type' => $org->OrganizationType,
                    'year' => $org->Year,
                    'position' => $org->Position
                ]);
            }
            $candidate->organizations()->saveMany($organizations);

            // Refferences
            $refferences = [];
            foreach($content->ReferencesAndRecomendations as $reff) {
                $refferences[] = new Refference([
                    'name' => $reff->ReferenceName,
                    'phone_number' => $reff->PhoneNumber,
                    'position' => $reff->Position,
                    'relationship' => $reff->Relationship
                ]);
            }
            $candidate->referrences()->saveMany($refferences);

            // Working Experiences
            foreach($content->WorkingExperiences as $workingExperience) {
                $workingExperience = $workingExperience->ExperienceDetail;
                $workingExpDetail = new WorkingExperience([
                    'working_status' => $workingExperience->StillWorking,
                    'industry' => $workingExperience->Industry,
                    'address' => $workingExperience->Address,
                    'start' => $workingExperience->Start,
                    'exit' => $workingExperience->ExitDate,
                    'exit_reasons' => $workingExperience->ExitReasons,
                    'allowance' => implode(", ",$workingExperience->Allowance)
                ]);

                $projects = [];
                foreach($workingExperience->Projects as $project) {
                    $projects[] = new WorkingProject([
                        'name' => $project->ProjectName,
                        'position' => $project->Position,
                        'division' => $project->Division,
                        'descriptions' => $project->Descriptions
                    ]);
                }
                $candidate->workingExperiences()->save($workingExpDetail)->projects()->saveMany($projects);
            }

            // Additional Information
            $additionalInformation = $content->AdditionalInformations;
            $candidate->additionalInformation()->create(
                [
                    'job_source_info' => $additionalInformation->WhereDidYouGetThisJobVacancy,
                    'hospitalize_status' => $additionalInformation->HaveYouBeenHospitalizedAndorSeriouslyIll,
                    'serious_ill' => $additionalInformation->SeriousIll,
                    'strenght' => $additionalInformation->Strenght,
                    'weakness' => $additionalInformation->Weakness,
                    'overcome_weakness' => $additionalInformation->HowYouOvercomeYourWeakness,
                    'expected_salary' => $additionalInformation->ExpectedSalary,
                    'estimate_join_date' => $additionalInformation->EstimateJoinDate,
                    'position' => $content->FORTHEPOSITION
                ]
            );

            // Documents
            $documents = [];
            foreach($content->AdditionalInformations->Documents as $type => $docs) {
                foreach($docs as  $docDetail){
                    $fileName = $docDetail->Id.$docDetail->Name;
                    $documents[] = new Documents([
                        'type' => $type,
                        'file_name' => $fileName,
                        'size' => $docDetail->Size,
                        'content_type' => $docDetail->ContentType,
                        'cognito_link' => $docDetail->File
                    ]);
                    try{
                        Storage::disk('docs')->put($fileName, file_get_contents($docDetail->File));
                    }catch(Error $e){
                        Logs::create([
                            "logs" => $filename." Error on saving docs ".$fileName
                        ]);
                        continue;
                    }
                }
            }
            $candidate->documents()->saveMany($documents);

            DB::commit();

            Logs::create([
                "logs" => $filename." Success on saving to DB [".$filename." - ".Carbon::now()->timestamp."]"
            ]);
        }catch (Exception $e) {

            DB::rollback();
            Logs::create([
                "logs" => $filename." Error on saving to DB ".$e->getMessage()
            ]);
            return response()->json([
                'message' => 'Error',
                'start' => $filename,
                'end' => Carbon::now()->timestamp
            ], 500);
        }
        
        return response()->json([
            'message' => 'Success',
            'start' => $filename,
            'end' => Carbon::now()->timestamp
        ], 200);
    }

    private function isNo($string) {
        if($string == 'No' || $string == 'NO' || $string == 'no') {
            return 0;
        } else {
            return 1;
        }
    }
}
