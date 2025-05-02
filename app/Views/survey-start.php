<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>DOSTX - Customer Satisfaction Survey Tool</title>

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
                                        
                                            <form id="frm-step-0" method="POST">
                                                <div class="row">
                                                        <div class="col-md-12 d-flex justify-content-center m-b-40">
                                                            <img class="text-center w-30" src="<?=base_url('assets/images/logo/logo-big.png')?>">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h4 class="text-center"><b>HELP US SERVE YOU BETTER!</b></h4>
                                                            <p class="text-dark"  style="text-align:justify;"> The <b>Client Satisfaction Measurement (CSM)</b> tracks the customer experience of government offices. Your feedback on your <u>recently concluded transaction</u> will help this office provide a better service.
                                                                Personal Information shared will be kept confidential and you always have the option not to answer this form.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 m-t-20 ">
                                                            <!-- <h5>I am transacting with:</h5> -->
                                                            <div class="btn-group-vertical btn-group-toggle w-100">
                                                            <a class="btn btn-primary mb-2 py-3" href="<?=base_url('survey/external')?>">External Client</a>
                                                            <a class="btn btn-primary mb-2 py-3" href="<?=base_url('survey/internal')?>">Internal Client</a>
                                                            </div>
                                                        </div>
                                                    </div>
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

        <!-- Core JS -->
        <script src="<?=base_url('assets/js/app.min.js')?>"></script>

    </body>
</html>