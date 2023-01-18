<?php echo $this->load->view('dashboard-layout'); ?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Edit Customer - <span class="fw-normal">Dashboard</span>
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
            <?php echo form_open('/dashboard/editcustomerinformation', array('id' => 'myform')) ?>
            <?php echo $this->session->flashdata('ResponseMessage'); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Biodata</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="form-label">Name:</label>
                                <input type="hidden" name="Id" value="<?php echo $selectedCustomer->CustomerId ?>">
                                <input type="text" name="Name" class="form-control" value="<?php echo $selectedCustomer->name ?>" placeholder="Enter Name">
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">NIK:</label>
                                <input type="text" name="NIK" class="form-control" value="<?php echo $selectedCustomer->nik ?>" placeholder="Enter NIK">
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Phone Number:</label>
                                <input type="text" name="PhoneNumber" class="form-control numeric-custom" value="<?php echo $selectedCustomer->phone_number ?>" placeholder="Enter Active Phone Number">
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Gender:</label>
                                <select name="Gender" data-placeholder="Select Gender" class="form-control-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" style="padding: 0px !important;">
                                    <option value="Male" <?php echo $selectedCustomer->gender == "Male" ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?php echo $selectedCustomer->gender == "Female" ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Address:</label>
                                <textarea name="Address" rows="3" cols="3" class="form-control" placeholder="Enter Address"><?php echo $selectedCustomer->address ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Account</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="form-label">Email:</label>
                                <input name="Email" type="text" class="form-control" value="<?php echo $selectedCustomer->email ?>" disabled placeholder="Enter Email">
                            </div>

                            <div class="row mb-3">
                                <label class="form-label">Password:</label>
                                <input name="Password" type="password" class="form-control" value="<?php echo $selectedCustomer->password ?>" disabled placeholder="Enter Password">
                            </div>

                            <div class="text-end">
                                <a href="<?php echo base_url() ?>dashboard/customer" class="btn btn-default">Back</a>
                                <button type="button" class="btn btn-secondary btn-submit">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php form_close() ?>
        </div>
    </div>

</div>
<!-- /page content -->

<script>
    var baseURL = '<?php echo base_url() ?>dashboard/';
</script>
<script src="<?php echo base_url() ?>assets/js/dashboard/customers/general.js?v=20221222.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>