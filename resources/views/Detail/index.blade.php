<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>{{ $candidate->fullname }} | Adidata Candidates</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/resume.css') }}" media="all" />
  </head>
  <body>
    <div id="doc2" class="yui-t7">
      <div id="inner">
        <img src="{{ asset("docs/".$candidate->getPhoto()->file_name) }}" alt="Photo" width="123" height="141">
        <div id="hd">
          <div class="yui-gc">
            <div class="yui-u first">
              <h1>{{ $candidate->fullname }}</h1>
              <h2>{{ $candidate->additionalInformation->position. " - ".number_format($candidate->additionalInformation->expected_salary)   }}</h2>
              <h3>Estimate Join: {{ $candidate->additionalInformation->estimate_join_date}}</h3>
            </div>
            <div class="yui-u">
              <div class="contact-info">
                <h3>
                  <a href="mailto:{{ $candidate->email }}">{{ $candidate->email }}</a>
                </h3>
                <h3>{{ $candidate->mobile_phone }}</h3>
                <h3>{{ $candidate->additionalInformation->job_source_info }}</h3>
                <a href="{{ route('ziparchive', $candidate->id) }}">Documents</a>
              </div>
              <!--// .contact-info -->
            </div>
          </div>
          <!--// .yui-gc -->
        </div>
        <!--// hd -->
        <div id="bd">
          <div id="yui-main">
            <div class="yui-b">
              <div class="yui-gf">
                <div class="yui-u first">
                  <h2>Personal Info</h2>
                </div>
                <!--// .yui-u -->
                <div class="yui-u">
                  <div class="job last">
                    <h2>Full Name</h2>
                    <h3>{{ $candidate->fullname }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Home Address</h2>
                    <h3>{{ $candidate->home_address }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Place, Date of Birth</h2>
                    <h3>{{ $candidate->place_of_birth.', '.$candidate->date_of_birth }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Gender</h2>
                    <h3>{{ $candidate->gender }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Freshgraduate</h2>
                    <h3>{{ ($candidate->freshgraduate == "0" ? "No" : "Yes") }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Blood Type</h2>
                    <h3>{{ $candidate->blood_type }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Home Phone - Mobile Phone</h2>
                    <h3>{{ $candidate->home_phone." - ".$candidate->mobile_phone }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Citizenship</h2>
                    <h3>{{ $candidate->citizenship }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Religion</h2>
                    <h3>{{ $candidate->religion }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Marital Status</h2>
                    <h3>{{ $candidate->marital_status." ".$candidate->mariage_year }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Religion</h2>
                    <h3>{{ $candidate->religion }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Emergency Situation Name</h2>
                    <h3>{{ $candidate->emergencyContact->name }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Emergency Situation Relation</h2>
                    <h3>{{ $candidate->emergencyContact->relation }}</h3>
                  </div>
                  <div class="job last">
                    <h2>Emergency Situation Number</h2>
                    <h3>{{ $candidate->emergencyContact->number }}</h3>
                  </div>
                </div>
              </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Family Data</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->families as $family) <div class="job">
                  <h2>{{ $family->name." - ".$family->status }}</h2>
                  <h3>{{ $family->education." - ".$family->occupation }}</h3>
                  <h4>{{ $family->gender }}</h4>
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Formal Education</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->formalEducation as $fEdu) <div class="job">
                  <h2>{{ $fEdu->grades." - ".$fEdu->institution." - ".$fEdu->major }}</h2>
                  <h3>{{ $fEdu->city }}</h3>
                  <h3>{{ $fEdu->start." - ".$fEdu->graduates }}</h3>
                  <h4>
                    <strong>{{ $fEdu->gpa }} GPA</strong>
                  </h4>
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Non-Formal Education</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->nonFormalEducation as $nfEdu) <div class="job">
                  <h2>{{ $nfEdu->course_name }}</h2>
                  <h3>{{ $nfEdu->year }}</h3>
                  <h3>{{ $nfEdu->duration }}</h3>
                  <h4>Certificate: {{ $nfEdu->certificate }}</h4>
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Languages</h2>
              </div>
              <div class="yui-u"> @foreach($candidate->languages as $lang) <div class="talent">
                  <h2>{{ $lang->language }}</h2>
                  <p>Written: {{ $lang->written }}</p>
                  <p>Speaking: {{ $lang->speaking }}</p>
                  <p>Reading: {{ $lang->reading }}</p>
                </div> @endforeach </div>
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Skills</h2>
              </div>
              <div class="yui-u"> @foreach($candidate->skills as $skill) <div class="talent">
                  <h2>{{ $skill->skill }}</h2>
                  <p>{{ $skill->proficiency_level }}</p>
                </div> @endforeach </div>
            </div>
            <!--// .yui-gf-->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Organization</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->organizations as $org) <div class="job">
                  <h2>{{ $org->name }}</h2>
                  <h3>{{ $org->type }}</h3>
                  <h3>{{ $org->position }}</h3>
                  <h4>{{ $org->year }}</h4>
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Refference</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->referrences as $org) <div class="job">
                  <h2>{{ $org->name }}</h2>
                  <h3>{{ $org->relationship }}</h3>
                  <h3>{{ $org->position }}</h3>
                  <h4>{{ $org->phone_number }}</h4>
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf">
              <div class="yui-u first">
                <h2>Working Experiences</h2>
              </div>
              <!--// .yui-u -->
              <div class="yui-u"> @foreach($candidate->workingExperiences as $exp) <div class="job last">
                  <h2>{{ $exp->name." - ".$exp->industry }}</h2>
                  <h3>{{ $exp->address }}</h3>
                  <h4>{{ $exp->start." - ".($exp->working_status == "1" ? "present" : $exp->exit)  }}</h4>
                  <h3>{{ number_format($exp->salary) }}</h3> @if ($exp->working_status == "0") <h3>{{ $exp->exit_reasons }}</h3> @endif <p></p>
                  <div class="job last">
                    <h2>Projects</h2> @foreach($exp->projects as $proj) <h3>{{ $proj->name." - ".$proj->position }}</h3>
                    <h3>{{ $proj->division }}</h3>
                    <p>{{ $proj->descriptions }}</p> @endforeach
                  </div>
                  <div class="yui-gf">
                    <div class="yui-u first">
                      <h2>Allowance</h2>
                    </div>
                    <div class="yui-u">
                      <ul class="talent"> @foreach(explode(", ",$exp->allowance) as $allow) <li>{{ $allow }}</li> @endforeach </ul>
                    </div>
                  </div>
                  <!--// .yui-gf-->
                </div> @endforeach </div>
              <!--// .yui-u -->
            </div>
            <!--// .yui-gf -->
            <div class="yui-gf last">
              <div class="yui-u first">
                <h2>Additional Information</h2>
              </div>
              <div class="yui-u">
                <div class="job last">
                  <h2>Strenght</h2>
                  <h3>{{ $candidate->additionalInformation->strenght }} </h3>
                </div>
                <div class="job last">
                  <h2>Weakness</h2>
                  <h3>{{ $candidate->additionalInformation->weakness }} </h3>
                  <h3>{{ $candidate->additionalInformation->overcome_weakness }}</h3>
                </div>
                <div class="job last">
                  <h2>Serious Ill</h2>
                  <h3>{{ ($candidate->additionalInformation->hospitalize_status = "Yes" ? $candidate->additionalInformation->serious_ill : "-") }} </h3>
                </div>
              </div>
            </div>
            <!--// .yui-gf -->
          </div>
          <!--// .yui-b -->
        </div>
        <!--// yui-main -->
      </div>
      <!--// bd -->
      <div id="ft">
        <p>PT. ADI DATA INFORMATIKA</p>
        <p>Gedung Graha Kencana Lt. 7 Jl. Raya Pejuangan No. 88, Kebon Jeruk. </p>
        <p>Jakarta Barat 11530, Indonesia</p>
      </div>
      <!--// footer -->
    </div>
    <!-- // inner -->
    </div>
    <!--// doc -->
  </body>
</html>