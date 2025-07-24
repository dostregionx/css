<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>DOSTX - Internal Survey Form</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/images/logo/favicon.png')?>">

        <!-- page css -->
        <link href="<?=base_url('assets/vendors/select2/select2.css')?>" rel="stylesheet">

        <!-- Core css -->
        <link href="<?=base_url('assets/css/app.min.css')?>" rel="stylesheet">

        <style>
            .bold-option {
                font-weight: bold;
            }
            .btn-group-toggle .btn {
                cursor: pointer;
            }

            .btn-group-toggle .btn input[type="radio"] {
                display: none;
            }

            .btn-group-toggle .btn input[type="radio"]:checked + label {
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show>.btn-primary.dropdown-toggle{
                color: white;
                background-color: #3f87f5 !important;
            }
            
        </style>
        <script>var BASE_URL = '<?=base_url()?>'; </script>
    </head>
    <body>
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url(<?=base_url('assets/images/others/login-3.png')?>)">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100">
                        <div class="row align-items-center w-100">
                            <div class="col-md-12 col-lg-10 m-h-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        
                                        <form id="frm-step-1" method="POST">
                                            
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-center m-b-10">
                                                    <img class="text-center" alt="" src="<?=base_url('assets/images/logo/logo.png')?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <h4 class="text-center"><b>HELP US SERVE YOU BETTER!</b></h4>
                                                    <p class="text-dark"  style="text-align:justify;"> The <b>Client Satisfaction Measurement (CSM)</b> tracks the customer experience of government offices. Your feedback on your <u>recently concluded transaction</u> will help this office provide a better service.
                                                        Personal Information shared will be kept confidential and you always have the option not to answer this form.
                                                    </p>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <label for="inputAddress"><b>Service Availed:</b> <span class="text-danger">*</span></label>
                                                    <select class="form-control" onchange="change_service(this)" class="form-control" name="servicesid" id="services-list" required>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="others_remarks_container">
                                                    <label for="others_remarks"><b>Others:</b> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="others_remarks" name="others_remarks" placeholder="Please specify" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="attending-dost-personnel"><b>Attending DOST Personnel:</b> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="attending-dost-personnel" name="dost_personnel" placeholder="Enter attending DOST personnel" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="client-type"><b>Client Type:</b> <span class="text-danger">*</span></label>
                                                    <?php foreach ($clienttype as $clienttypeRow) { ?>
                                                        <div class="radio">
                                                            <input type="radio" id="rdoclienttype<?=$clienttypeRow['clienttypeid']?>" name="clienttypeid" value="<?=$clienttypeRow['clienttypeid']?>" required/>
                                                            <label for="rdoclienttype<?=$clienttypeRow['clienttypeid']?>"><?=$clienttypeRow['name']?></label>
                                                        </div>
                                                    <?php } ?>
                                                    <div style="color:red; display: none;" aria-live="polite">Please select a client type</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"><b>Name:</b> <small>(optional)</small></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="date"><b>Date</b>: <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="date" name="date" max="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sex"><b>Sex:</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="rdosex1" value="Male" name="sex" required/>
                                                        <label for="rdosex1">Male</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdosex2" value="Female" name="sex" />
                                                        <label for="rdosex2">Female</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="age"><b>Age:</b> <span class="text-danger">*</span></label>
                                                    <!-- <input type="number" class="form-control" name="age" id="age" placeholder="Enter age" required/> -->
                                                    <select name="age" class="form-control" required>
                                                        <option value="">Select age group...</option>
                                                        <?php foreach ($agegroup as $agegroupRow) { ?>
                                                            <option value="<?=$agegroupRow['agegroupid']?>"><?=$agegroupRow['agegroup']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="vulnerable-sector"><b>Vulnerable Sector:</b> <small>(optional)</small></label>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkvs1" name="vul_sector" value="Senior Citizen"/>
                                                        <label for="chkvs1">Senior Citizen</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkvs2" name="vul_sector" value="Persons With Disability" />
                                                        <label for="chkvs2">Persons With Disability</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkvs3" name="vul_sector" value="4P's Beneficiary" />
                                                        <label for="chkvs3">4P's Beneficiary</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkvs4" name="vul_sector" value="Indigenous People" />
                                                        <label for="chkvs4">Indigenous People</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address"><b>Address (City/Municipality):</b> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required/>
                                                </div>
                                                <?php if ($surveytype == 'external') { ?>
                                                <div class="form-group">
                                                    <label for="how-did-you-know-dost"><b>How did you know DOST?:</b> <span class="text-danger">*</span></label>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk1" name="dost_info" value="Facebook"/>
                                                        <label for="chkhdyk1">Facebook</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk2" name="dost_info" value="Radio" />
                                                        <label for="chkhdyk2">Radio</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk3" name="dost_info" value="Referral" />
                                                        <label for="chkhdyk3">Referral (Word of Mouth)</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk4" name="dost_info" value="Website" />
                                                        <label for="chkhdyk4">Website</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk5" name="dost_info" value="TV" />
                                                        <label for="chkhdyk5">TV</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="chkhdyk6" name="dost_info" value="Others" />
                                                        <label for="chkhdyk6">Others</label>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <?php if ($surveytype == 'external') { ?>
                                                    <button type="button" onclick="backForm(1,0)" class="btn btn-primary btn-tone m-r-5">Back</button>
                                                <?php } ?>
                                                <button type="submit" class="btn btn-primary">Next</button>
                                        </form>
                                            <form id="frm-step-2" method="POST" style="display:none;">
                                                <p class="text-dark" >
                                                    INSTRUCTIONS: Select your answer to the <b>Citizen's Charter (CC)</b> questions. The Citizen's Charter is an official document that reflects the services of a government agency/office including its
                                                    requirements, fees, and processing times among others.
                                                </p>
                                                <p class="text-primary" >Note: The survey already contains answers. If you agree with the provided answers, simply click <strong>Next</strong>. Otherwise, feel free to change them by selecting your desired response and click <strong>Next</strong>.</p>

                                                <div class="form-group">
                                                    <label for="cc1"><b>CC1: Which of the following best describes your awareness of a Citizen's Charter?</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC1-1" name="cc1" value="4" checked required/>
                                                        <label for="rdoCC1-1">I know what a Citizen's Charter is and I saw this office's Citizen's Charter.</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC1-2" name="cc1" value="3" />
                                                        <label for="rdoCC1-2">I know what a Citizen's Charter is but did NOT see this office's Citizen's Charter.</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC1-3" name="cc1" value="2" />
                                                        <label for="rdoCC1-3">I learned of the Citizen's Charter only when I saw this office's Citizen's Charter.</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC1-4" name="cc1" value="1" />
                                                        <label for="rdoCC1-4">I do not know what a Citizen's Charter is and I did not see one in this office.</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc2"><b>CC2: If aware of Citizen's Charter (answered 1-3 in CC1), would you say that the Citizen's Charter of this office was ...?</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC2-1" name="cc2" value="4" checked required/>
                                                        <label for="rdoCC2-1">Easy to see</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC2-2" name="cc2" value="3" />
                                                        <label for="rdoCC2-2">Somewhat easy to see</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC2-3" name="cc2" value="2" />
                                                        <label for="rdoCC2-3">Difficult to see</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC2-4" name="cc2" value="1" />
                                                        <label for="rdoCC2-4">Not visible at all</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc3"><b>CC3: If aware of Citizen's Charter (answered 1-3 in CC1), how much did the Citizen's Charter help you in your transaction?</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC3-1" name="cc3" value="3" checked required/>
                                                        <label for="rdoCC3-1">Helped very much</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC3-2" name="cc3" value="2" />
                                                        <label for="rdoCC3-2">Somewhat helped</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="rdoCC3-3" name="cc3" value="1" />
                                                        <label for="rdoCC3-3">Did not help</label>
                                                    </div>
                                                </div>
                                                <button type="button" onclick="backForm(2,1)" class="btn btn-primary btn-tone m-r-5">Back</button>
                                                <button type="submit" class="btn btn-primary">Next</button>
                                            </form>
                                            <form id="frm-step-3" method="POST" style="display:none;">
                                                <p class="text-dark" >INSTRUCTIONS: For SQD 0-8, please put a check mark (✔) on the column that best corresponds with your answer.</p>
                                                <p class="text-primary" >Note: The survey already contains answers. If you agree with the provided answers, simply click <strong>Submit</strong>. Otherwise, feel free to change them by selecting your desired response and click <strong>Submit</strong>.</p>
                                                <div class="form-group">
                                                    <label for="sqd0"><b>SQD0. I am satisfied with the service that I availed.</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd0_strongly_agree" name="sqd0" value="5" checked />
                                                        <label for="sqd0_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd0_agree" name="sqd0" value="4" />
                                                        <label for="sqd0_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd0_neither" name="sqd0" value="3" />
                                                        <label for="sqd0_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd0_disagree" name="sqd0" value="2" />
                                                        <label for="sqd0_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd0_strongly_disagree" name="sqd0" value="1" />
                                                        <label for="sqd0_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd1"><b>SQD1. I spent a reasonable amount of time for my transaction.</b> <span class="text-danger">*</span></label>

                                                    <div class="radio">
                                                        <input type="radio" id="sqd1_strongly_agree" name="sqd1" value="5" checked />
                                                        <label for="sqd1_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd1_agree" name="sqd1" value="4" />
                                                        <label for="sqd1_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd1_neither" name="sqd1" value="3" />
                                                        <label for="sqd1_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd1_disagree" name="sqd1" value="2" />
                                                        <label for="sqd1_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd1_strongly_disagree" name="sqd1" value="1" />
                                                        <label for="sqd1_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd2"><b>SQD2. The office followed the transaction's requirements and steps based on the information provided.</b> <span class="text-danger">*</span></label>

                                                    <div class="radio">
                                                        <input type="radio" id="sqd2_strongly_agree" name="sqd2" value="5" checked />
                                                        <label for="sqd2_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd2_agree" name="sqd2" value="4" />
                                                        <label for="sqd2_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd2_neither" name="sqd2" value="3" />
                                                        <label for="sqd2_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd2_disagree" name="sqd2" value="2" />
                                                        <label for="sqd2_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd2_strongly_disagree" name="sqd2" value="1" />
                                                        <label for="sqd2_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd3"><b>SQD3. The steps I needed to do for my transaction were easy</b> <span class="text-danger">*</span></label>

                                                    <div class="radio">
                                                        <input type="radio" id="sqd3_strongly_agree" name="sqd3" value="5" checked />
                                                        <label for="sqd3_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd3_agree" name="sqd3" value="4" />
                                                        <label for="sqd3_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd3_neither" name="sqd3" value="3" />
                                                        <label for="sqd3_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd3_disagree" name="sqd3" value="2" />
                                                        <label for="sqd3_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd3_strongly_disagree" name="sqd3" value="1" />
                                                        <label for="sqd3_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd4"><b>SQD4. I easily found information about my transaction from the office's website.</b> <span class="text-danger">*</span></label>

                                                    <div class="radio">
                                                        <input type="radio" id="sqd4_strongly_agree" name="sqd4" value="5" checked />
                                                        <label for="sqd4_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd4_agree" name="sqd4" value="4" />
                                                        <label for="sqd4_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd4_neither" name="sqd4" value="3" />
                                                        <label for="sqd4_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd4_disagree" name="sqd4" value="2" />
                                                        <label for="sqd4_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd4_strongly_disagree" name="sqd4" value="1" />
                                                        <label for="sqd4_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd5"><b>SQD5. I paid a reasonable amount of fees for my transaction.</b></label>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_strongly_agree" name="sqd5" value="5" />
                                                        <label for="sqd5_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_agree" name="sqd5" value="4" />
                                                        <label for="sqd5_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_neither" name="sqd5" value="3" />
                                                        <label for="sqd5_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_disagree" name="sqd5" value="2" />
                                                        <label for="sqd5_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_strongly_disagree" name="sqd5" value="1" />
                                                        <label for="sqd5_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd5_not_available" name="sqd5" value="0" checked />
                                                        <label for="sqd5_not_available">Not Available</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd6"><b>SQD6. I am confident my online transaction was secure.</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_strongly_agree" name="sqd6" value="5" checked />
                                                        <label for="sqd6_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_agree" name="sqd6" value="4" />
                                                        <label for="sqd6_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_neither" name="sqd6" value="3" />
                                                        <label for="sqd6_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_disagree" name="sqd6" value="2" />
                                                        <label for="sqd6_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_strongly_disagree" name="sqd6" value="1" />
                                                        <label for="sqd6_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd6_not_available" name="sqd6" value="0" checked />
                                                        <label for="sqd6_not_available">Not Available</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd7"><b>SQD7. The office's online support was available, and (if asked questions) online support was quick to respond</b> <span class="text-danger">*</span></label>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd7_strongly_agree" name="sqd7" value="5" checked />
                                                        <label for="sqd7_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd7_agree" name="sqd7" value="4" />
                                                        <label for="sqd7_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd7_neither" name="sqd7" value="3" />
                                                        <label for="sqd7_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd7_disagree" name="sqd7" value="2" />
                                                        <label for="sqd7_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd7_strongly_disagree" name="sqd7" value="1" />
                                                        <label for="sqd7_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sqd8"><b>SQD8. I got what I needed from the government office, or (if denied) denial of request was sufficiently explained to me.</b> <span class="text-danger">*</span></label>

                                                    <div class="radio">
                                                        <input type="radio" id="sqd8_strongly_agree" name="sqd8" value="5" checked />
                                                        <label for="sqd8_strongly_agree">Strongly Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd8_agree" name="sqd8" value="4" />
                                                        <label for="sqd8_agree">Agree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd8_neither" name="sqd8" value="3" />
                                                        <label for="sqd8_neither">Neither Agree nor Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd8_disagree" name="sqd8" value="2" />
                                                        <label for="sqd8_disagree">Disagree</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" id="sqd8_strongly_disagree" name="sqd8" value="1" />
                                                        <label for="sqd8_strongly_disagree">Strongly Disagree</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="suggestions"><b>Suggestions on how we can further improve our services:</b> <small>(optional)</small></label>
                                                    <textarea class="form-control" id="suggestions" name="suggestions"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email"><b>Email address:</b> <small>(optional)</small></label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                                <button type="button" onclick="backForm(3,2)" class="btn btn-primary btn-tone m-r-5">Back</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex p-h-40 justify-content-between">
                        <span class="">2024 DOST 10 - ROCJ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Vendors JS -->
        <script src="<?=base_url('assets/js/vendors.min.js')?>"></script>

        <!-- page js -->
        <script src="<?=base_url('assets/vendors/select2/select2.min.js')?>"></script>

        <!-- Core JS -->
        <script src="<?=base_url('assets/js/app.min.js')?>"></script>

        
        <script>
            var officeid = '';
            var services = <?=json_encode($services)?>;
            var servicesUpdated = [];

            enableNextButtonZero(null);

            $(document).ready(function () {

                $('#others_remarks_container').hide();

                if('<?=$surveytype?>' == 'internal'){
                    $("#frm-step-1").hide();
                }else{
                    $("#frm-step-1").show();
                }

                $("#frm-step-0").submit(function (e) { 
                    frm0data = $("#frm-step-0").serializeArray();
                    $("#frm-step-0").hide();
                    $("#frm-step-1").show();
                    e.preventDefault();
                });

                $("#frm-step-1").submit(function (e) { 
                    frm1data = $("#frm-step-1").serializeArray();

                    if('<?=$surveytype?>' == 'external'){
                        frm1data.push({name: "officeid", value: officeid});
                    }

                    $("#frm-step-1").hide();
                    $("#frm-step-2").show();
                    e.preventDefault();
                });

                $("#frm-step-2").submit(function (e) {
                    frm2data = $("#frm-step-2").serializeArray();
                    $("#frm-step-2").hide();
                    $("#frm-step-3").show();
                    e.preventDefault();
                });

                $("#frm-step-3").submit(function (e) {
                    frm3data = $("#frm-step-3").serializeArray();

                    $.post(BASE_URL+"survey/save",{
                        form1:frm1data,
                        form2:frm2data,
                        form3:frm3data
                    },function(data){
                        if (data == "SUCCESS") {
                            $('#frm-step-1')[0].reset();
                            $('#frm-step-3 input[type="email"]').val('');
                            $('#frm-step-3 textarea').val('');
                            window.location.href = BASE_URL+"thank-you";
                        }else{
                            console.log(data);
                        }
                    });
                    e.preventDefault();
                });
            });

            function backForm(current,previous){
                $("#frm-step-"+previous).show();
                $("#frm-step-"+current).hide();
            }

            function enableNextButtonZero(element) {
            servicesUpdated = [];

                var othersService = null;
                for (var i = 0; i < services.length; i++) {
                    if (1==1) {
                            servicesUpdated.push(services[i]);
                    }
                }
    
                var options = '<option value="">Select Service...</option>';
                for (var i = 0; i < servicesUpdated.length; i++) {
                    options += '<option data-name="' + servicesUpdated[i].name + '" value="' + servicesUpdated[i].servicesid + '">' + servicesUpdated[i].name;

                    if ((servicesUpdated[i].unit != null && servicesUpdated[i].unit != '') && (servicesUpdated[i].name != null && servicesUpdated[i].name != '')) {
                        options += " - ";
                    }

                    if (servicesUpdated[i].unit != null && servicesUpdated[i].unit != '') {
                        options += servicesUpdated[i].unit;
                    }
                    options += '</option>';
                }
                $('#services-list').html(options);

            
            $("#btnFirstNext").prop('disabled','');
        }

        function change_service(x){
            var selectedOption = $(x).find('option:selected');
            var selectedName = selectedOption.data('name');

            if (selectedName == "Others") {
                $('#others_remarks_container').show();
                $('#others_remarks').attr('required', true);
                $('#others_remarks').val('');
            } else {
                $('#others_remarks_container').hide();
                $('#others_remarks').attr('required', false);
                $('#others_remarks').val('');
            }
        }
        </script>

    </body>
</html>