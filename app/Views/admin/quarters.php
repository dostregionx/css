<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Quarters</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a class="breadcrumb-item" href="#">Registry</a>
                <span class="breadcrumb-item active">Quarters</span>
            </nav>
        </div>
    </div>
    <?php if (isset($_SESSION['update'])) { ?>
        <div class="mt-3 alert alert-success alert-dismissible fade show" id="alert-update-status">
            <div class="d-flex align-items-center justify-content-start">
                <span class="alert-icon">
                    <i class="anticon anticon-check-o"></i>
                </span>
                <span>The status has been updated successfully!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-body">
            <h4>Quarter Period Status</h4>
            <p>This table displays the status of quarters, showing the semesters and their corresponding quarters. Only one quarter can be set to active at a time.</p>
            <div class="m-t-25">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Quarter</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cntr = 0; foreach ($quarters as $quartersRow) { ?>
                                <tr data-quarterid="<?= $quartersRow['quarterid'] ?>" data-is-active="<?= $quartersRow['is_active'] ?>">
                                    <th scope="row"><?= $cntr += 1; ?></th>
                                    <td><?= $quartersRow['semester'] ?></td>
                                    <td><?= $quartersRow['quarter'] ?></td>
                                    <td>
                                        <?php if ($quartersRow['is_active'] == 1) { ?>
                                            <span class="badge badge-pill badge-green">Active</span>
                                        <?php } else { ?>
                                            <span class="badge badge-pill badge-red">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($quartersRow['is_active'] == 1) { ?>
                                            <button class="btn btn-xs btn-danger btn-rounded" disabled>
                                                <i class="anticon anticon-poweroff"></i>
                                            </button>
                                        <?php } else { ?>
                                            <a href="<?= base_url('admin/activate_quarter/' . $quartersRow['quarterid']) ?>" role="button" class="btn btn-xs btn-success btn-rounded">
                                                <i class="anticon anticon-poweroff"></i>
                                            </a>
                                        <?php } ?>
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