<?= $this->extend('admin/main'); ?>  <!-- Extends the 'main' layout -->
<?= $this->section('content'); ?>  <!-- Start of 'content' section -->

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Generate</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a class="breadcrumb-item" href="#">Reports</a>
                <span class="breadcrumb-item active">Generate</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15">
                            <label for="">Office</label>
                            <select class="custom-select" id="selofficeid" style="min-width: 50px;">
                                <option value="all">All</option>
                                <?php
                                $officeid_from_url = isset($_GET['officeid']) ? $_GET['officeid'] : '';

                                foreach ($offices as $officesRow) { ?>
                                    <option value="<?=$officesRow['officeid']?>" <?= ($officesRow['officeid'] == $officeid_from_url) ? 'selected' : '' ?>>
                                        <?=$officesRow['name']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="m-b-10 m-r-15">
                            <label for="">Select Type</label>
                            <select class="custom-select" id="typeSelector" style="min-width: 80px;">
                                <option value="semester">Semester</option>
                                <option value="quarter" selected>Quarter</option>
                            </select>
                        </div>

                        <div class="m-b-10 m-r-15" id="semesterContainer">
                            <label for="">Semester</label>
                            <select class="custom-select" id="selSemesterId" style="min-width: 80px;" style="display: none;">
                                <option value="all">All</option>
                                <?php 
                                    $semesterid_from_url = isset($_GET['semesterid']) ? $_GET['semesterid'] : '';
                                    foreach ($semesters as $semestersRow) { ?>
                                    <option value="<?=$semestersRow['semesterid']?>" <?= ($semestersRow['semesterid'] == $semesterid_from_url) ? 'selected' : '' ?>>
                                        <?=$semestersRow['semester']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="m-b-10 m-r-15" id="quarterContainer">
                            <label for="">Quarter</label>
                            <select class="custom-select" id="selQuarterId" style="min-width: 80px;">
                                <?php 

                                
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

                                    foreach ($quarters as $quartersRow) { ?>
                                        <option value="<?=$quartersRow['quarterid']?>" <?= ("Q".$quartersRow['quarterid'] == "Q".$quarterid) ? 'selected' : '' ?>>
                                            <?=$quartersRow['quarter']?>
                                        </option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="m-b-10 m-r-15"><label for="">Year</label>
                            <select class="custom-select" id="selyear" style="min-width: 30px;">
                                <?php 
                                $currentYear = date('Y');
                                $selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;
                                for ($i = $currentYear - 5; $i <= $currentYear; $i++) { 
                                    $selected = ($i == $selectedYear) ? 'selected' : ''; 
                                ?>
                                    <option value="<?= $i ?>" <?= $selected ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="m-b-10 m-r-15">
                            <label for="" class="text-white">-</label>
                            <button onclick="applyFilter()" class="btn btn-block btn-primary" id="btnFilter">
                            <i class="anticon anticon-loading m-r-5"></i><span>Filter</span>
                            </button>
                        </div>
                        <div class="m-b-10 m-r-15">
                            <label for="" class="text-white">-</label>
                            <a class="btn btn-info btn-block btn-tone" href="#" target="_blannk" id="btndownloadpdf" role="button"><i class="anticon anticon-download"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="data-view-container">

            </div>
        </div>
    </div>
</div>


<script>
    $('#typeSelector').change(function() {
        var selectedType = $(this).val();
        if (selectedType === 'semester') {
            $('#semesterContainer').show();
            $('#quarterContainer').hide();
        } else if (selectedType === 'quarter') {
            $('#semesterContainer').hide();
            $('#quarterContainer').show();
        }
    });

    // Trigger the change event on page load to set the correct initial state
    $('#typeSelector').trigger('change');

    $(document).ready(function () {
        
        
        applyFilter();

    });

    function applyFilter(){

        $("#btnFilter").addClass("is-loading");
        setTimeout(function() { $("#btnFilter").removeClass("is-loading");}, 1000);

        var selyear = $("#selyear").val();
        var selquarterid = $("#selQuarterId").val();
        var selsemesterid = $("#selSemesterId").val();
        var selofficeid = $("#selofficeid").val();
        var typeselector = $("#typeSelector").val();

        $("#btndownloadpdf").attr("href", BASE_URL+"reports/gen_pdf?year="+selyear+"&quarterid="+selquarterid+"&semesterid="+selsemesterid+"&officeid="+selofficeid+"&typeselector="+typeselector);

        $.post(BASE_URL+'reports/gen_result',{
            year : selyear,
            officeid : selofficeid,
            semesterid : selsemesterid,
            quarterid : selquarterid,
            typeselector : typeselector

        },function(data){
            $("#data-view-container").html(data);
        });
    }
</script>

<?= $this->endSection(); ?>  <!-- End of 'content' section -->
