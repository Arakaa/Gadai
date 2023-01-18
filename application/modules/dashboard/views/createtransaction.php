<?php echo $this->load->view('dashboard-layout'); ?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Create Transaction - <span class="fw-normal">Dashboard</span>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Customer Information</h5>
                </div>
                <div class="card-body border-top">
                    <div class="row">
                        <?php echo $this->session->flashdata('ResponseMessage'); ?>
                        <div class="col-md-7">
                            <?php echo form_open('/dashboard/submittransaction', array('id' => 'myform')) ?>
                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Date</label>
                                <div class="col-lg-6">
                                    <input type="text" name="Date" class="form-control datepicker-date-format datepicker-input" readonly value="<?php echo date('Y-m-d'); ?>" placeholder="Enter date">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Transaction Code</label>
                                <div class="col-lg-6">
                                    <input type="text" name="Code" class="form-control" placeholder="Enter Transaction Code">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Customer</label>
                                <div class="col-lg-6">
                                    <select name="Customer" data-placeholder="Select Customer" class="form-control form-control-select2 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option selected hidden></option>
                                        <?php foreach ($activeCustomers as $row) { ?>
                                            <option value="<?php echo $row['CustomerId'] ?>"><?php echo $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">NIK</label>
                                <div class="col-lg-6">
                                    <input type="text" name="NIK" class="form-control" placeholder="Enter NIK">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Address</label>
                                <div class="col-lg-6">
                                    <input type="text" name="Address" class="form-control" placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Phone Number</label>
                                <div class="col-lg-6">
                                    <input type="text" name="Phone" class="form-control numeric-custom" placeholder="Enter Phone Number">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Item Name</label>
                                <div class="col-lg-6">
                                    <input type="text" name="ItemName" class="form-control" placeholder="Enter Item Name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Item Code</label>
                                <div class="col-lg-6">
                                    <input type="text" name="ItemCode" class="form-control" placeholder="Enter Item Code">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Price</label>
                                <div class="col-lg-6">
                                    <input type="text" name="Price" class="form-control numeric-custom" placeholder="Enter Price Estimate">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Pay</label>
                                <div class="col-lg-4">
                                    <select name="Pay" data-placeholder="Select Pay" class="form-control form-control-select2 select2-hidden-accessible" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                        <option selected hidden></option>
                                        <option value="3">3</option>
                                        <option value="6">6</option>
                                        <option value="12">12</option>
                                    </select>
                                    <label class="form-text text-danger">Charge: <span id="text-interest"></span></label>
                                </div>
                                <label class="col-lg-2 col-form-label">month(s)</label>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-3 col-form-label">Description</label>
                                <div class="col-lg-6">
                                    <textarea name="Description" rows="3" cols="3" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <?php form_close() ?>
                        </div>
                        <div class="col-md-5">
                            <table class="table" id="table-result">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>Month</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary btn-submit">Create Transaction <i class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->

<template id="template-body-table-result">
    <tr>
        <td><span id="template-body-month"></span></td>
        <td><span id="template-body-due"></span></td>
        <td><span id="template-body-price"></span></td>
    </tr>
</template>

<script>
    var baseURL = '<?php echo base_url() ?>dashboard/';
</script>
<script src="<?php echo base_url() ?>assets/js/dashboard/transactions/general.js?v=20221229.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>