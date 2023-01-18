<?php echo $this->load->view('dashboard-layout'); ?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Customer - <span class="fw-normal">Dashboard</span>
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
        <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                <div class="vr d-none d-sm-block flex-shrink-0 my-2 mx-3"></div>

                <div class="d-inline-flex mt-3 mt-sm-0">
                    <span id="realtime-calendar">-</span>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page header -->


<!-- Page content -->
<div class="page-content pt-0">

    <?php echo $this->load->view('dashboard-navigation') ?>

    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <?php echo $this->session->flashdata('ResponseMessage'); ?>
                    <div class="card">
                        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                            <h5 class="py-sm-2 my-sm-1">Filter</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Name:</label>
                                            <input type="text" name="Name" class="form-control" value="<?php echo $this->session->flashdata('model')['name'] ?? '' ?>" placeholder="Enter Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">NIK:</label>
                                            <input type="text" name="NIK" class="form-control" value="<?php echo $this->session->flashdata('model')['nik'] ?? '' ?>" placeholder="Enter NIK">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Email:</label>
                                            <input type="text" name="Email" class="form-control" value="<?php echo $this->session->flashdata('model')['email'] ?? '' ?>" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label class="form-label">Status:</label>
                                            <select name="Status" data-placeholder="Select Status" id="Status" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <option value="1" <?php echo $this->session->flashdata('model')['status'] == "1" ? 'selected' : '' ?>>Active</option>
                                                <option value="0" <?php echo $this->session->flashdata('model')['status'] == "0" ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <button type="button" class="btn btn-success mt-4 btn-filter">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                            <h5 class="py-sm-2 my-sm-1">Customer Data</h5>
                            <div class="mt-2 mt-sm-0 ms-sm-auto">
                                <a href="<?php echo base_url() ?>dashboard/createcustomer" class="btn btn-sm btn-secondary">
                                    <i class="ph-plus ph-lg me-2"></i>
                                    Create New
                                </a>
                            </div>
                        </div>
                        <div>
                            <table class="table" id="table-listing">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th class="col-md-3">Name</th>
                                        <th class="col-md-3">NIK</th>
                                        <th class="col-md-3">Email</th>
                                        <th class="col-md-1">Status</th>
                                        <th class="text-center col-md-2"><i class="ph-dots-three"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($dataCustomers) > 0) {

                                        foreach ($dataCustomers as $row) {
                                    ?>
                                            <tr>
                                                <td class="col-md-3"><?php echo $row['name']; ?></td>
                                                <td class="col-md-2"><?php echo $row['nik']; ?></td>
                                                <td class="col-md-3"><?php echo $row['email']; ?></td>
                                                <td class="col-md-1">
                                                    <div class="dropdown">
                                                        <a href="#" class="badge <?php echo ($row['status'] ? 'bg-success' : 'bg-danger'); ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?php echo ($row['status'] ? 'Active' : 'Inactive'); ?></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <?php if ($row['status']) { ?>
                                                                <a href="<?php echo base_url() . 'dashboard/changecustomerstatus/0/' . $row['AuthId']; ?>" class="dropdown-item">
                                                                    <span class="bg-danger border-danger rounded-pill p-1 me-2"></span>
                                                                    Inactive
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url() . 'dashboard/changecustomerstatus/1/' . $row['AuthId']; ?>" class="dropdown-item">
                                                                    <span class="bg-success border-success rounded-pill p-1 me-2"></span>
                                                                    Active
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center col-md-2">
                                                    <div class="d-inline-flex">
                                                        <a href="#" class="text-body" onclick="viewCustomer(<?php echo $row['CustomerId']; ?>)">
                                                            <i class="ph-eye"></i>
                                                        </a>
                                                        <a href="#" class="text-body mx-2" onclick="editCustomer(<?php echo $row['CustomerId']; ?>)">
                                                            <i class="ph-pen"></i>
                                                        </a>
                                                        <a href="#" class="text-body" onclick="deleteCustomer(<?php echo $row['CustomerId']; ?>)">
                                                            <i class="ph-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="5">There is no data.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<div id="modal_view" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="#">
                    <fieldset>
                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Biodata</legend>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Name:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-name"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">NIK:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-nik"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Phone Number:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-phone"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Gender:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-gender"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Address:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-address"></div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend class="fs-base fw-bold border-bottom pb-2 mb-3">Account Information</legend>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-email"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">Status:</label>
                            <div class="col-lg-9">
                                <div class="form-control form-control-plaintext" id="modal-view-status"></div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var baseURL = '<?php echo base_url() ?>dashboard/';
</script>
<script src="<?php echo base_url() ?>assets/js/dashboard/customers/index.js?v=20221231.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>