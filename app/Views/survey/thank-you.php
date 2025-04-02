<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>DOST X - Customer Satisfaction Survey Tool</title>

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
                                        <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <div class="row">
    <div class="col-md-12 d-flex justify-content-center align-items-center">
        <img class="img-fluid" alt="" src="<?=base_url('assets/images/others/thank-you.gif')?>">
    </div>
    <div class="col-md-12">
        <h4 class="text-center"><b>Thank You for Your Feedback!</b></h4>
        <p style="text-align:justify;"> Thank you for taking the time to complete our customer service survey. Your feedback is invaluable in helping us maintain and improve the quality of service we provide.
        </p>
        <div class="text-center m-t-30">
            <button onclick="returnPrev()" class="btn btn-primary btn-sm btn-tone">Take Another Survey</button>
        </div>
    </div>
</div>

                                        </div>
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
            function returnPrev(){
                window.history.back();
            }
        </script>

    </body>
</html>