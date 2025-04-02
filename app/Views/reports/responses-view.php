<?= $this->extend('admin/main'); ?>  <!-- Extends the 'main' layout -->
<?= $this->section('content'); ?>  <!-- Start of 'content' section -->

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Responses</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a class="breadcrumb-item" href="#">Reports</a>
                <span class="breadcrumb-item active">Responses</span>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15"><label for="">Service Type</label>
                        <?php
                            $servicetype = isset($_GET['servicetype']) ? $_GET['servicetype'] : 'all';
                            ?>

                            <select class="custom-select" id="selservicetype" style="min-width: 50px;">
                                <option value="all" <?php echo $servicetype == 'all' ? 'selected' : ''; ?>>All</option>
                                <option value="1" <?php echo $servicetype == '1' ? 'selected' : ''; ?>>External</option>
                                <option value="0" <?php echo $servicetype == '0' ? 'selected' : ''; ?>>Internal</option>
                            </select>
                        </div>
                        <?php if ($_SESSION['usertype'] == 'admin') { ?>
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
                        <?php }else{ ?>
                            <input type="hidden" id="selofficeid" value="<?=$_SESSION['officeid']; ?>">
                        <?php } ?>
                        <div class="m-b-10 m-r-15">
                            <label for="">Quarter</label>
                            <select class="custom-select" id="selquarterid" style="min-width: 80px;">
                                <option value="all">All</option>
                                <?php 
                                
                                    $quarterid_from_url = isset($_GET['quarterid']) ? $_GET['quarterid'] : '';

                                    foreach ($quarters as $quartersRow) { ?>
                                    <option value="<?=$quartersRow['quarterid']?>" <?= ($quartersRow['quarterid'] == $quarterid_from_url) ? 'selected' : '' ?>>
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
                                for ($i = $currentYear; $i >= $currentYear-5; $i--) { 
                                    $selected = ($i == $selectedYear) ? 'selected' : ''; 
                                ?>
                                    <option value="<?= $i ?>" <?= $selected ?>><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="m-b-10 m-r-15">
                            <label for="" class="text-white">-</label>
                            <button onclick="applyFilter()" class="btn btn-block btn-primary">
                                <span>Apply</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Service Availed</th>
                                <th scope="col">Others Remarks</th>
                                <th scope="col">DOST Personnel</th>
                                <th scope="col">Client Type</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Sex</th>
                                <th scope="col">Age</th>
                                <th scope="col">Vulnerable Sector</th>
                                <th scope="col">Address</th>
                                <th scope="col">How did you know DOST?</th>
                                <th scope="col">CC1</th>
                                <th scope="col">CC2</th>
                                <th scope="col">CC3</th>
                                <th scope="col">SQD0</th>
                                <th scope="col">SQD1</th>
                                <th scope="col">SQD2</th>
                                <th scope="col">SQD3</th>
                                <th scope="col">SQD4</th>
                                <th scope="col">SQD5</th>
                                <th scope="col">SQD6</th>
                                <th scope="col">SQD7</th>
                                <th scope="col">SQD8</th>
                                <th scope="col">Suggestions</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cntr=0; foreach ($responses as $reponsesRow) {
                                ?>
                                <tr>
                                    <td><?=$cntr+=1?></td>
                                    <td>
                                        <?=$reponsesRow['service_name'];
                                        
                                            if($reponsesRow['service_unit'] != null || $reponsesRow['service_unit'] != '') { echo " - ".$reponsesRow['service_unit']; }else{ echo ""; } ?>
                                    </td>
                                    <td><?=$reponsesRow['others_remarks']?></td>
                                    <td><?=$reponsesRow['dost_personnel']?></td>
                                    <td><?=$reponsesRow['client_type_name']?></td>
                                    <td><?=$reponsesRow['summary_name']?></td>
                                    <td><?=date('F j, Y',strtotime($reponsesRow['summary_date']))?></td>
                                    <td><?=$reponsesRow['summary_sex']?></td>
                                    <td><?=$reponsesRow['agegroup']?></td>
                                    <td><?=$reponsesRow['summary_vul_sector']?></td>
                                    <td><?=$reponsesRow['summary_address']?></td>
                                    <td><?=$reponsesRow['summary_dost_info']?></td>
                                    <td><?=$reponsesRow['cc1']?></td>
                                    <td><?=$reponsesRow['cc2']?></td>
                                    <td><?=$reponsesRow['cc3']?></td>


                                    <td><?=$reponsesRow['sqd0']?></td>
                                    <td><?=$reponsesRow['sqd1']?></td>
                                    <td><?=$reponsesRow['sqd2']?></td>
                                    <td><?=$reponsesRow['sqd3']?></td>
                                    <td><?=$reponsesRow['sqd4']?></td>
                                    <td><?=$reponsesRow['sqd5']?></td>
                                    <td><?=$reponsesRow['sqd6']?></td>
                                    <td><?=$reponsesRow['sqd7']?></td>
                                    <td><?=$reponsesRow['sqd8']?></td>
                                    <td><?=$reponsesRow['suggestions']?></td>
                                    <td><?=$reponsesRow['sqd_email']?></td>
                                    <td><?=date('F j, Y h:i A',strtotime($reponsesRow['summary_date_created']))?></td>
                                </tr>
                                <?php
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var is_external = '<?=$_GET['servicetype']?>';

        if (is_external == 1) {
            $("title").text('DOST X - Customer Satisfaction Survey (External) Responses');
        }else if(is_external == 0){
            $("title").text('DOST X - Customer Satisfaction Survey (Internal) Responses');
        }else{
            $("title").text('DOST X - Customer Satisfaction Survey (All) Responses');

        }
    });


    $('#data-table').DataTable({
            ordering: false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5'
            ]
            // paging: true, scrollCollapse: true, scrollY: '50vh' 
        });

    function applyFilter(){
        var selyear = $("#selyear").val();
        var selquarterid = $("#selquarterid").val();
        var selofficeid = $("#selofficeid").val();
        var is_external = $("#selservicetype").val();

        window.location.href = BASE_URL+'reports/responses?servicetype='+is_external+'&year='+selyear+'&quarterid='+selquarterid+'&officeid='+selofficeid;
    }
</script>

<?= $this->endSection(); ?>  <!-- End of 'content' section -->
