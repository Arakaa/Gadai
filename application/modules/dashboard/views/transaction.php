<?php echo $this->load->view('dashboard-layout'); ?>

<style>
    .scrollable-section {
        height: 50vh;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Transaction - <span class="fw-normal">Dashboard</span>
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
                                        <div class="col-md-3">
                                            <label class="form-label">Daterange:</label>
                                            <button type="button" class="btn btn-dark daterange-listing d-block">
                                                <i class="ph-calendar me-2"></i>
                                                <span>November 22, 2022 &nbsp; - &nbsp; December 21, 2022</span>
                                            </button>
                                            <input type="hidden" name="Daterange" class="form-control" value="<?php echo $this->session->flashdata('model')['daterange'] ?? '' ?>" placeholder="Enter Daterange">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Transaction Code:</label>
                                            <input type="text" name="Code" class="form-control" value="<?php echo $this->session->flashdata('model')['code'] ?? '' ?>" placeholder="Enter Transaction Code">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Status:</label>
                                            <select name="Status" data-placeholder="Select Status" id="Status" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <option value="1" <?php echo $this->session->flashdata('model')['status'] == "1" ? 'selected' : '' ?>>Incompleted</option>
                                                <option value="2" <?php echo $this->session->flashdata('model')['status'] == "2" ? 'selected' : '' ?>>Completed</option>
                                                <option value="3" <?php echo $this->session->flashdata('model')['status'] == "3" ? 'selected' : '' ?>>Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Status Payment:</label>
                                            <select name="StatusPayment" data-placeholder="Select Status" id="StatusPayment" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <option value="1" <?php echo $this->session->flashdata('model')['statuspayment'] == "1" ? 'selected' : '' ?>>Unpaid</option>
                                                <option value="2" <?php echo $this->session->flashdata('model')['statuspayment'] == "2" ? 'selected' : '' ?>>Partial Paid</option>
                                                <option value="3" <?php echo $this->session->flashdata('model')['statuspayment'] == "3" ? 'selected' : '' ?>>Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <label class="form-label">Customer:</label>
                                            <select name="Customer" data-placeholder="Select Customer" id="Customer" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <?php foreach ($activeCustomers as $row) { ?>
                                                    <option value="<?php echo $row['CustomerId'] ?>" <?php echo $this->session->flashdata('model')['customer'] == $row['CustomerId'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Item:</label>
                                            <select name="Item" data-placeholder="Select Item" id="Item" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <?php foreach ($activeItems as $row) { ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo $this->session->flashdata('model')['item'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?> (<?php echo $row['code'] ?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Description:</label>
                                            <input type="text" name="Description" class="form-control" value="<?php echo $this->session->flashdata('model')['desc'] ?? '' ?>" placeholder="Enter Description">
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
                        <div class="table-responsive">

                            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                                <h5 class="py-sm-2 my-sm-1">Transaction Data</h5>
                                <div class="mt-2 mt-sm-0 ms-sm-auto">
                                    <a href="<?php echo base_url() ?>dashboard/createtransaction" class="btn btn-sm btn-secondary">
                                        <i class="ph-plus ph-lg me-2"></i>
                                        Create New
                                    </a>
                                </div>
                            </div>
                            <div>
                                <table class="table" id="table-listing">
                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th class="col-md-1">Date</th>
                                            <th class="col-md-2">Transaction Code</th>
                                            <th class="col-md-2">Customer</th>
                                            <th class="col-md-2">Item</th>
                                            <th class="col-md-2">Description</th>
                                            <th class="col-md-2">Status</th>
                                            <th class="text-center col-md-1"><i class="ph-dots-three"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($dataTransactions) > 0) {

                                            foreach ($dataTransactions as $row) {
                                                $labelStatus = "";
                                                $classStatus = "";
                                                $labelStatusPayment = "";
                                                $classStatusPayment = "";
                                                if ($row['status_payment'] == 1) {
                                                    $labelStatus = "Unpaid";
                                                    $classStatus = "bg-danger";
                                                } else if ($row['status_payment'] == 2) {
                                                    $labelStatus = "Partial Paid";
                                                    $classStatus = "bg-warning";
                                                } else if ($row['status_payment'] == 3) {
                                                    $labelStatus = "Paid";
                                                    $classStatus = "bg-success";
                                                }
                                                if ($row['TransactionStatus'] == 1) {
                                                    $labelStatusPayment = "Incompleted";
                                                    $classStatusPayment = "bg-secondary";
                                                } else if ($row['TransactionStatus'] == 2) {
                                                    $labelStatusPayment = "Completed";
                                                    $classStatusPayment = "bg-success";
                                                } else if ($row['TransactionStatus'] == 3) {
                                                    $labelStatusPayment = "Cancelled";
                                                    $classStatusPayment = "bg-danger";
                                                }
                                        ?>
                                                <tr>
                                                    <td class="col-md-1"><?php echo $row['date']; ?></td>
                                                    <td class="col-md-2"><?php echo $row['TransactionCode']; ?></td>
                                                    <td class="col-md-2"><?php echo $row['CustomerName']; ?></td>
                                                    <td class="col-md-2"><?php echo $row['ItemName'] . ' (' . $row['ItemCode'] . ')'; ?></td>
                                                    <td class="col-md-2"><?php echo $row['description']; ?></td>
                                                    <td class="col-md-2">
                                                        <?php if ($row['TransactionStatus'] == 1) { ?>
                                                            <div class="dropdown">
                                                                <a href="#" class="badge <?php echo $classStatusPayment; ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $labelStatusPayment; ?></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a href="<?php echo base_url() . 'dashboard/changetransactionstatus/3/' . $row['TransactionId']; ?>" class="dropdown-item">
                                                                        <span class="bg-danger border-danger rounded-pill p-1 me-2"></span>
                                                                        Cancelled
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php } else { ?>
                                                            <span class="badge <?php echo $classStatusPayment; ?>"><?php echo $labelStatusPayment; ?></span>
                                                        <?php } ?>
                                                        <span class="badge <?php echo $classStatus; ?>"><?php echo $labelStatus; ?></span>
                                                    </td>
                                                    <td class="text-center col-md-2">
                                                        <div class="d-inline-flex">
                                                            <a href="#" class="text-body" onclick="viewTransaction(<?php echo $row['TransactionId']; ?>)">
                                                                <i class="ph-eye"></i>
                                                            </a>
                                                            <?php if ((int)$row['TransactionStatus'] !== 3 && ((int)$row['status_payment'] === 1 || (int)$row['status_payment'] === 2)) { ?>
                                                                <a href="#" class="text-body mx-2" onclick="viewPayment(<?php echo $row['TransactionId']; ?>)">
                                                                    <i class="ph-note"></i>
                                                                </a>
                                                            <?php } ?>
                                                            <?php if ((int)$row['status_payment'] === 1 && (int)$row['TransactionStatus'] === 1) { ?>
                                                                <a href="#" class="text-body" onclick="editTransaction(<?php echo $row['TransactionId']; ?>)">
                                                                    <i class="ph-pen"></i>
                                                                </a>
                                                            <?php } ?>
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
</div>
<!-- /page content -->

<div id="modal_view" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Transaction Code:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-code"></div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Customer:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-customer"></div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">NIK:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-nik"></div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Phone Number:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-phone"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Item Name:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-item-name"></div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Item Code:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-item-code"></div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Address:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-address"></div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label class="col-lg-6 col-form-label">Status:</label>
                            <div class="col-lg-6">
                                <div class="form-control form-control-plaintext" id="modal-view-status"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-1">
                        <label class="col-lg-3 col-form-label">Description:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext" id="modal-view-desc"></div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label class="col-lg-3 col-form-label">Grandtotal:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext" id="modal-view-grand"></div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label class="col-lg-3 col-form-label">Pay:</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext" id="modal-view-pay"></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table-view-invoices">
                        <thead>
                            <tr class="table-dark">
                                <th class="col-md-2">Month</th>
                                <th class="col-md-4">Due Date</th>
                                <th class="col-md-4">Amount</th>
                                <th class="col-md-2">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary visually-hidden" data-id="0" id="print-transaction"><i class="ph-printer ph-lg me-2"></i> Print</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_pay" class="modal fade" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Payment</h5>
                <input type="hidden" id="modal-payment-transaction-id">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="scrollable-section">
                    <div class="table-responsive">
                        <table class="table" id="table-view-payment">
                            <thead>
                                <tr class="table-dark">
                                    <th class="col-md-2">Month</th>
                                    <th class="col-md-4">Due Date</th>
                                    <th class="col-md-4">Amount</th>
                                    <th class="col-md-2">Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="form-horizontal">
                    <br />
                    <div class="content-divider text-muted form-group"><span>Payment Information</span></div>
                    <div class="row">
                        <label class="col-lg-12 col-form-label text-danger">*There is a charge for every bill that overlap the due date. (Rp. 5,000/day)</label>
                    </div>
                    <div class="row">
                        <label class="col-lg-2 col-form-label">Amount Owed</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext" id="modal-payment-grand"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-2 col-form-label">Pay for</label>
                        <div class="col-lg-4">
                            <select name="Pay" data-placeholder="Select Pay for" class="form-control form-control-select2 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-2 col-form-label">Include Charge</label>
                        <div class="d-flex flex-wrap align-content-around p-2 col-lg-4">
                            <input type="checkbox" disabled name="isCharge" class="form-check-input">
                        </div>
                    </div>
                    <div class="row my-1">
                        <label class="col-lg-2 col-form-label">Amount Paid</label>
                        <div class="col-lg-9">
                            <div class="form-control form-control-plaintext" id="modal-payment-amount"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-lg-2 col-form-label">Payment Method</label>
                        <div class="col-lg-4">
                            <select name="Method" data-placeholder="Select Payment Method" class="form-control form-control-select2 select2-hidden-accessible" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                <option selected hidden></option>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary" id="submit-payment">Submit Payment</button>
            </div>
        </div>

    </div>
</div>
</div>

<script>
    var baseURL = '<?php echo base_url() ?>dashboard/';
</script>
<script src="<?php echo base_url() ?>assets/js/dashboard/transactions/index.js?v=20221226.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>