<?php
header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=CV-".$candidate->fullname.".doc");
?>
<style type="text/css">
    page {
        font-family: 'Times New Roman', Times, serif;
    }
    div.note {
        border: solid 1mm #DDDDDD;
        background-color: #EEEEEE;
        padding: 2mm;
        border-radius: 2mm;
        width: 100%;
    }

    ul.main {
        width: 95%;
        list-style-type: square;
    }

    ul.main li {
        padding-bottom: 2mm;
    }

    h4 {
        text-align: center;
        font-size: 5mm;
        font-weight: normal;
        text-decoration: underline;
    }

    .title {
        font-weight: bold;
        font-size: 5mm
    }

    table {
        font-size: 3.5mm
    }
    
    .sub-table {
        padding-top: -2; 
        padding-left: -3; 
        width: 100%;
    }

    table td,
        {
        padding-top: 2mm
    }

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

    .text-footer {
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


    <!-- Content here!-->
    <h4> CURRICULUM VITAE </h4>

    <!-- Personal Information -->
    <table style="width: 100%">
        <tbody>
            <tr>
                <td colspan="3">Yang bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td style="text-align: left;  width: 5%; ">1.</td>
                <td style="text-align: left;  width: 30%; ">Nama</td>
                <td style="text-align: left;  width: 65%">: {{ $candidate->fullname }}</td>
            </tr>
            <tr>
                <td style="text-align: left;  width: 5%; ">2.</td>
                <td style="text-align: left;  width: 30%; ">Kebangsaan</td>
                <td style="text-align: left;  width: 65%">: {{ ($candidate->citizenship == 'Indonesia' ? 'WNI' : 'WNA') }}</td>
            </tr>
            <tr>
                <td style="text-align: left;  width: 5%; ">3.</td>
                <td style="text-align: left;  width: 30%; ">Tempat dan tanggal lahir</td>
                <td style="text-align: left;  width: 60%">: {{ $candidate->place_of_birth.", ".DateTime::createFromFormat('Y-m-d', $candidate->date_of_birth)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: left;  width: 5%; ">4.</td>
                <td style="text-align: left;  width: 30%; ">Alamat</td>
                <td style="text-align: left;  width: 60%">: {{ $candidate->home_address }}</td>
            </tr>
            <tr>
                <td style="text-align: left;  width: 5%; ">5.</td>
                <td style="text-align: left;  width: 30%; ">Pendidikan</td>
                <td style="text-align: left;  width: 60%">: {{ $candidate->getLastEducation()->grades." - ".$candidate->getLastEducation()->major.", ".$candidate->getLastEducation()->institution.", ".DateTime::createFromFormat('Y-m-d', $candidate->getLastEducation()->graduates)->format('Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: left; vertical-align: text-top; width: 5%; ">6.</td>
                <td colspan="2" style="padding-top: 0; vertical-align: top; text-align: left; width: 95%;">
                    <table class="sub-table">
                        <tr>
                            <td style="text-align: left;  width: 40%; ">PENGALAMAN KERJA/PROYEK</td>
                            <td style="text-align: left;  width: 30%; ">JABATAN</td>
                            <td style="text-align: left;  width: 30%; ">TAHUN</td>
                        </tr>
                        @foreach ($candidate->workingExperiences as $index => $workingExperiences)
                            <tr>
                                <td style="text-align: left;  width: 40%; ">{{ $workingExperiences->name }}</td>
                                <td style="text-align: left;  width: 30%; ">{{ $workingExperiences->getLastProject()->position }}</td>
                                <td style="text-align: left;  width: 30%; ">{{ DateTime::createFromFormat('Y-m-d', $workingExperiences->start)->format('Y').($workingExperiences->working_status ? "" : " - ".DateTime::createFromFormat('Y-m-d', $workingExperiences->exit)->format('Y')) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: left; vertical-align: text-top; width: 5%; ">7.</td>
                <td colspan="2" style="padding-top: 0; vertical-align: top; text-align: left; width: 95%;">
                    <table class="sub-table">
                        <tr>
                            <td style="text-align: left;  width: 40%; ">SERTIFIKASI/TRAINING</td>
                            <td style="text-align: left;  width: 30%; ">TAHUN</td>
                            <td style="text-align: left;  width: 30%; "></td>
                        </tr>
                        @foreach ($candidate->nonFormalEducation as $index => $nonFormalEducation)
                            <tr>
                                <td style="text-align: left;  width: 40%; ">{{ $nonFormalEducation->course_name }}</td>
                                <td style="text-align: left;  width: 30%; ">{{ $nonFormalEducation->year }}</td>
                                <td style="text-align: left;  width: 30%; "></td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br/><br/><br/><br/>
    <img src="{{ getcwd() }}/logo.png"/ style="width: 200px;">
</page>
