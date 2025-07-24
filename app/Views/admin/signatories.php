<?= $this->extend('admin/main'); ?>  <!-- Extends the 'main' layout -->
<?= $this->section('content'); ?>  <!-- Start of 'content' section -->
<div class="main-content">
    <?php if (isset($_SESSION['update'])) { ?>
        <div class="mt-3 alert alert-success alert-dismissible fade show" id="alert-update-status">
            <div class="d-flex align-items-center justify-content-start">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                <span>The signatory/approver has been updated successfully!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php } ?>

       <?php if (isset($_SESSION['deleted'])) { ?>
        <div class="mt-3 alert alert-danger alert-dismissible fade show" id="alert-update-status">
            <div class="d-flex align-items-center justify-content-start">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                <span>The signatory/approver has been deleted successfully!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php } ?>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Signatories</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#signatoryModal">
                    <i class="anticon anticon-plus"></i> Add Signatory
                </button>
            </div>
            <p class="mb-3">
                This table displays the status of quarters, showing the semesters and their corresponding quarters. Only one quarter can be set to active at a time.
            </p>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Signatory</th>
                                <th scope="col">Position</th>
                                <th scope="col">Office</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=0; foreach ($signatories as $signatory): ?>
                                <?php $details = htmlspecialchars(json_encode($signatory), ENT_QUOTES, 'UTF-8'); ?>
                                <tr>
                                    <td><?=$count+=1?></td>
                                    <td><?= $signatory['signatory'] ?></td>
                                    <td><?= $signatory['position'] ?></td>
                                    <td><?= $signatory['office'] ?></td>
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-info edit-signatory-btn"
                                            data-details="<?= $details ?>"
                                            data-toggle="modal"
                                            data-target="#editSignatoryModal"
                                        >
                                            Edit
                                        </button>
                                             <button 
                                            class="btn btn-sm btn-danger delete-signatory-btn" onclick="deleteSignatory(<?=$signatory['signatoryid']?>)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Approver</h4>
               <?php if (!isset($approver)) {
                ?>
                 <button class="btn btn-primary" data-toggle="modal" data-target="#approverModal">
                    <i class="anticon anticon-plus"></i> Add Approver
                </button>
                
                <?php
               }?>

            </div>
            <p class="mb-3">
                This table displays the status of quarters, showing the semesters and their corresponding quarters. Only one quarter can be set to active at a time.
            </p>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Approver</th>
                                <th scope="col">Position</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php if (isset($approver)) {
                                ?>
                                
                                  <tr>
                                    <td>1</td>
                                    <td><?=$approver['signatory']?></td>    
                                    <td><?=$approver['position']?></td>      
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-info edit-approver-btn"
                                            data-details="<?= htmlspecialchars(json_encode($approver), ENT_QUOTES, 'UTF-8') ?>"
                                            data-toggle="modal"
                                            data-target="#editApproverModal"
                                        >
                                            Edit
                                        </button>
                                        <button 
                                            class="btn btn-sm btn-danger delete-signatory-btn" onclick="deleteSignatory(<?=$approver['signatoryid']?>)"
                                        >
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                                
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal: Add/Edit Signatory -->
<div class="modal fade" id="signatoryModal" tabindex="-1" role="dialog" aria-labelledby="signatoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="signatoryForm" method="post" action="<?= site_url('registry/save-signatory'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signatoryModalLabel">Add Signatory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="office">Office</label>
                        <select name="office" id="" class="form-control" required>
                            <option value="All">All</option>
                            <?php foreach ($offices as $office) { ?>
                                <option value="<?=$office['shorthand']?>"><?=$office['name']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="signatory">Signatory</label>
                        <input type="text" class="form-control" name="signatory" id="signatory" required>
                    </div>

                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" name="position" id="position" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Signatory</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="editSignatoryModal" tabindex="-1" role="dialog" aria-labelledby="editSignatoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editSignatoryForm" method="post" action="<?= site_url('registry/update-signatory'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSignatoryModalLabel">Edit Signatory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group">
                        <label for="edit_signatory">Signatory Name</label>
                        <input type="text" class="form-control" name="signatory" id="edit_signatory" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_position">Position</label>
                        <input type="text" class="form-control" name="position" id="edit_position" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_office">Office</label>
                        <select name="office" id="edit_office" class="form-control" required>
                            <option value="All">All</option>
                            <?php foreach ($offices as $office): ?>
                                <option value="<?= $office['shorthand'] ?>"><?= $office['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" name="is_approver" id="edit_is_approver">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal: Add/Edit Approver -->
<div class="modal fade" id="approverModal" tabindex="-1" role="dialog" aria-labelledby="approverModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="approverForm" method="post" action="<?= site_url('registry/save-signatory'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="approverModalLabel">Add Approver</h5>
                        <small class="text-muted">This approver is for all offices.</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden is_approver input -->
                    <input type="hidden" name="is_approver" value="1">
                    <div class="form-group">
                        <label for="approver_name">Approver Name</label>
                        <input type="text" class="form-control" name="signatory" id="approver_name" required>
                    </div>

                    <div class="form-group">
                        <label for="approver_position">Position</label>
                        <input type="text" class="form-control" name="position" id="approver_position" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Approver</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Approver -->
<div class="modal fade" id="editApproverModal" tabindex="-1" role="dialog" aria-labelledby="editApproverModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editApproverForm" method="post" action="<?= site_url('registry/update-signatory'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="editApproverModalLabel">Edit Approver</h5>
                        <small class="text-muted">This approver is for all offices.</small>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_approver_id">
                    <input type="hidden" name="is_approver" value="1">

                    <div class="form-group">
                        <label for="edit_approver_name">Approver Name</label>
                        <input type="text" class="form-control" name="signatory" id="edit_approver_name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_approver_position">Position</label>
                        <input type="text" class="form-control" name="position" id="edit_approver_position" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<form id="deleteForm" method="post" style="display: none;"></form>

<script>
    $(document).ready(function () {
        $('.edit-signatory-btn').on('click', function () {
            const data = JSON.parse($(this).attr('data-details'));

            $('#edit_id').val(data.signatoryid);
            $('#edit_signatory').val(data.signatory);
            $('#edit_position').val(data.position);
            $('#edit_office').val(data.office || 'All');
            $('#edit_is_approver').val(data.is_approver);
        });

        $('.edit-approver-btn').on('click', function () {
            const data = JSON.parse($(this).attr('data-details'));

            $('#edit_approver_id').val(data.signatoryid);
            $('#edit_approver_name').val(data.signatory);
            $('#edit_approver_position').val(data.position);
        });
    });

    function deleteSignatory(signatoryid) {
            const form = document.getElementById('deleteForm');
            form.action = 'delete-signatory/' + signatoryid;
            form.submit();
    }
</script>

<?= $this->endSection(); ?>  <!-- End of 'content' section -->