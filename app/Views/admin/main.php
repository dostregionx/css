<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DOST X - Customer Satisfaction Survey Tool</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png') ?>">

    <!-- Page CSS -->
    <link href="<?= base_url('assets/vendors/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables/buttons.dataTables.min.css') ?>" />

    <!-- Core CSS -->
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet">
    
    <script>var BASE_URL = '<?= base_url() ?>'; </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= base_url('assets/vendors/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables/dataTables.bootstrap.min.js') ?>"></script>

    <!-- Core Vendors JS -->
    <script src="<?= base_url('assets/js/vendors.min.js') ?>"></script>

    <!-- Core JS -->
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/vendors/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables/buttons.html5.min.js') ?>"></script>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="<?= base_url('') ?>">
                        <img src="<?= base_url('assets/images/logo/logo.png') ?>" alt="Logo">
                        <img class="logo-fold" src="<?= base_url('assets/images/logo/logo-fold.png') ?>" alt="Logo">
                    </a>
                </div>
    
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image m-h-10 m-r-15">
                                    <i class="anticon anticon-user"></i>
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-icon">
                                            <i class="anticon anticon-user"></i>
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold"><?= strtoupper(session()->get('username')) ?></p>
                                            <p class="m-b-0 opacity-07"><?= session()->get('office') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('logout') ?>" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <!-- <li class="nav-item dropdown">
                            <a href="<?= base_url('admin/dashboard') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-pie-chart"></i>
                                </span>
                                <span class="title">Registry</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li>
                                    <a href="<?= base_url('admin/registry/quarters') ?>">Quarters</a>
                                </li> -->
                                <li>
                                    <a href="<?= base_url('registry/signatories') ?>">Signatories</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-file-text"></i>
                                </span>
                                <span class="title">Surveys</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= base_url('survey/external') ?>">External</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('survey/internal') ?>">Internal</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-file-done"></i>
                                </span>
                                <span class="title">Reports</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                                        $officeid = '';
                                        if (session()->get('usertype') == 'admin') {
                                            $officeid = 'all';
                                        } else {
                                            $officeid = session()->get('officeid');
                                        }

                                        $quarterid = 0;

                                        $currentMonth = date('n');
                                        if ($currentMonth >= 1 && $currentMonth <= 3) {
                                            $quarterid = 1;
                                        } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
                                            $quarterid = 2;
                                        } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
                                            $quarterid = 3;
                                        } else {
                                            $quarterid = 4;
                                        }                    



                                    ?>
                                    <a href="<?= base_url('reports/responses?servicetype=all&year=' . date('Y') . '&quarterid=' . $quarterid . '&officeid=' . $officeid) ?>">Responses</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('reports/generate') ?>">Generate</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <?= $this->renderSection('content') ?>
                <!-- Footer START -->
                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">2024 DOST 10 - ROCJ.</p>
                    </div>
                </footer>
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>
</body>

</html>
