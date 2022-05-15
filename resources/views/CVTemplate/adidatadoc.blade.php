<?php
header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=CV-".$candidate->fullname.".doc");
?>
<style type="text/css">
    div.note {border: solid 1mm #DDDDDD;background-color: #EEEEEE; padding: 2mm; border-radius: 2mm; width: 100%; }
    ul.main { width: 95%; list-style-type: square; }
    ul.main li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm}
    h3 { text-align: center; font-size: 14mm}
    .title { font-weight: bold; font-size: 5mm}
    table td, { padding-top: 2mm}
    .logo {
      position: absolute;
      width: 75mm;
      height: 14mm;
      left: 124mm;
      top: 16mm;
      background: url({{ getcwd() }}/logo.png) right no-repeat;
    }

    .line-logo {
      position: absolute;
      width: 188mm;
      height: 0mm;
      left: 11mm;
      top: 33mm;
      border: 0.5mm solid #000000;
    }

    .text-footer{
      position: absolute;
      width: 210mm;
      height: 28mm;
      left: 0mm;
      font-weight: 400;
      font-size: 4mm;
      line-height: 5mm;
      text-align: center;

      color: #000000;
    }
    .sub_title {
      padding-left: 5mm;

    }
    .sub_projects {
      padding-left: 15mm;

    }
</style>
<page backtop="40mm" backbottom="30mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
    <page_header>
        <div class="logo"></div>
        <div class="line-logo"></div>
    </page_header>
    <!-- Content here!-->
    <h3> Curriculum Vitae </h3>

    <!-- Personal Information -->
    <table style="width: 100%">
      <tbody>
        <tr>
          <td colspan="3" class="title">Personal Detail</td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr >
          <td style="text-align: left;  width: 30%; padding-left: 5mm;">Name</td>
          <td style="text-align: left;  width: 50%">: {{ $candidate->fullname }}</td>
          <td rowspan="8" style="text-align: left;  width: 20%">
            <img src="{{ asset("docs/".$candidate->getPhoto()->file_name) }}" alt="Photo" width="123" height="141">
        </td>
        </tr>
        <tr>
          <td class=sub_title>Place, date of birth</td>
          <td>: {{ $candidate->place_of_birth.", ".DateTime::createFromFormat('Y-m-d', $candidate->date_of_birth)->format('d F Y') }}</td>
        </tr>
        <tr>
          <td class=sub_title>Religion</td>
          <td>: {{ $candidate->religion }}</td>
        </tr>
        <tr>
          <td class=sub_title>Marital Status</td>
          <td>: {{ $candidate->marital_status }}</td>
        </tr>
        <tr>
          <td class=sub_title>Sex</td>
          <td>: {{ $candidate->gender }}</td>
        </tr>
        <tr>
          <td class=sub_title>Nationality</td>
          <td>: {{ $candidate->citizenship }}</td>
        </tr>
      </tbody>
    </table>
    <br>

    <!-- Education -->
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td colspan="2" class="title">Education</td>
        </tr>
        <!-- Loop -->
        @foreach ($candidate->formalEducation as $index => $formalEducation)
            <tr>
                <td  class=sub_title style="vertical-align: top; text-align: left;  width: 30%">
                {{ $index+1 .'. '.substr($formalEducation->start, 0, 4)."-".substr($formalEducation->graduates, 0, 4) }}
                </td>
                <td style="text-align: left;  width: 70%">
                : {{ $formalEducation->major." - ".$formalEducation->institution.", ".$formalEducation->gpa }}
                </td>
            </tr>  
        @endforeach
        <!-- End Loop -->
      </tbody>
    </table>
    <br>
    <!-- Non Formal Education -->
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td colspan="2" class="title">Non Formal Education</td>
        </tr>
        <!-- Loop -->
        @foreach ($candidate->nonFormalEducation as $index => $nonFormalEducation)
            <tr>
                <td  class=sub_title style="vertical-align: top; text-align: left;  width: 30%">
                {{ $index+1 .". ".$nonFormalEducation->year }}
                </td>
                <td style="text-align: left;  width: 70%">
                : {{ $nonFormalEducation->course_name }}
                </td>
            </tr>   
        @endforeach
        <!-- End Loop -->
        
        
      </tbody>
    </table>
    <br>
    <!-- Experiences -->
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td colspan="2" class="title">Experiences</td>
        </tr>
        <!-- Start Loop Experience -->
        @foreach ($candidate->workingExperiences as $index => $workingExperiences)
            <tr style="vertical-align: top; text-align: left;  width: 20%">
                <td class="sub_title">
                {{ $index+1 .". ".DateTime::createFromFormat('Y-m-d', $workingExperiences->start)->format('M Y')." - ".($workingExperiences->working_status ? "at present" : DateTime::createFromFormat('Y-m-d', $workingExperiences->exit)->format('M Y') ) }}
                </td>
                <td>
                : {{ $workingExperiences->name }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 10mm">Projects</td>
            </tr>
            <!-- Start Loop Projects -->
            @foreach ($workingExperiences->projects as $project)
                <tr>
                    <td class="sub_projects" colspan="2">
                    {{ $project->name." - ".$project->position }}
                    </td>
                </tr>
                <tr>
                    <td class="sub_projects" colspan="2" style="width: 100%;">
                    {!! nl2br(e($project->descriptions)) !!}
                    </td>
                </tr>
            @endforeach
            <!-- END LOOP -->
        @endforeach
        <!-- END LOOP -->
      </tbody>
    </table>
    <br>
    <!-- Language Proficiencies -->
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td colspan="4" class="title">Language Proficiencies</td>
        </tr>
        <tr>
            <td  class=sub_title style="vertical-align: top; text-align: left;  width: 40%"></td>
            <td style="text-align: center;  width: 20%">Written</td>
            <td style="text-align: center;  width: 20%">Speaking</td>
            <td style="text-align: center;  width: 20%">Reading</td>
        </tr>
        <!-- Loop -->
        @foreach ($candidate->languages as $language)
            <tr>
                <td  class=sub_title style="vertical-align: top; text-align: left;  width: 40%">
                    {{ $language->language }}
                </td>
                <td style="text-align: center;  width: 20%">
                    {{ $language->written }}
                </td>
                <td style="text-align: center;  width: 20%">
                    {{ $language->speaking }}
                </td>
                <td style="text-align: center;  width: 20%">
                    {{ $language->reading }}
                </td>
            </tr>                
        @endforeach
        <!-- End Loop -->
      </tbody>
    </table>
    <br>
    <!-- Skills -->
    <table style="width: 100%;">
      <tbody>
        <tr>
          <td colspan="2" class="title">Skills</td>
        </tr>
        <!-- Loop -->
        @foreach ($candidate->skills as $skill)
            <tr>
                <td  class=sub_title style="vertical-align: top; text-align: left;  width: 30%">
                    {{ $skill->skill }}
                </td>
                <td style="text-align: left;  width: 70%">
                    {{ $skill->proficiency_level }}
                </td>
            </tr>
        @endforeach
        <!-- End Loop -->
      </tbody>
    </table>
</page>
