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
                    <table class="table table-hover table-sm" id="data-table">
                        <thead>
                            <tr>
                                <th scope="col"><small>No.</small></th>
                                <th scope="col"><small>Service Availed</small></th>
                                <th scope="col"><small>Others Remarks</small></th>
                                <th scope="col"><small>Type of Market <small>(RSTL)</small></small></th>
                                <th scope="col"><small>What service/s of the RSTL have you availed? <small>(RSTL)</small></small></th>
                                <th scope="col"><small>Attending DOST Personnel</small></th>
                                <th scope="col"><small>Client Type</small></th>
                                <th scope="col"><small>Client Name</small></th>
                                <th scope="col"><small>Date</small></th>
                                <th scope="col"><small>Sex</small></th>
                                <th scope="col"><small>Age</small></th>
                                <th scope="col"><small>Vulnerable Sector</small></th>
                                <th scope="col"><small>Address (City/Municipality)</small></th>
                                <th scope="col"><small>How did you know DOST?</small></th>
                                <th scope="col"><small>CC1: Which of the following best describes your awareness of a Citizen's Charter?</small></th>
                                <th scope="col"><small>CC2: If aware of Citizen's Charter (answered 1-3 in CC1), would you say that the Citizen's Charter of this office was ...?</small></th>
                                <th scope="col"><small>CC3: If aware of Citizen's Charter (answered 1-3 in CC1), how much did the Citizen's Charter help you in your transaction?</small></th>
                                <th scope="col"><small>SQD0. I am satisfied with the service that I availed.</small></th>
                                <th scope="col"><small>SQD1. I spent a reasonable amount of time for my transaction.</small></th>
                                <th scope="col"><small>SQD2. The office followed the transaction's requirements and steps based on the information provided.</small></th>
                                <th scope="col"><small>SQD3. The steps I needed to do for my transaction were easy.</small></th>
                                <th scope="col"><small>SQD4. I easily found information about my transaction from the office or its website.</small></th>
                                <th scope="col"><small>SQD5. I paid an acceptable amount of fees for my transaction.</small></th>
                                <th scope="col"><small>SQD6. I am confident my online transaction was secure.</small></th>
                                <th scope="col"><small>SQD7. I was treated courteously by the staff, and (if asked for help) the staff was helpful.</small></th>
                                <th scope="col"><small>SQD8. I got what I needed from the government office.</small></th>
                                <th scope="col"><small>SQD9. The services were provided at the promised time.</small></th>
                                <th scope="col"><small>SQD10. The services that I received are accurate.</small></th>
                                <th scope="col"><small>How likely is it that you would recommend our services to others?</small></th>
                                <th scope="col"><small>Suggestions on how we can further improve our services or other services that you additionally require:</small></th>
                                <th scope="col"><small>Email Address</small></th>
                                <th scope="col"><small>Date Submitted</small></th>
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
                                    <td><?=$reponsesRow['typeofmarket']?></td>
                                    <td><?=$reponsesRow['rstlservice_availed']?></td>
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
                                    <td><?=$reponsesRow['sqd9']?></td>
                                    <td><?=$reponsesRow['sqd10']?></td>

                                    <td><?=$reponsesRow['recommend']?></td>
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
