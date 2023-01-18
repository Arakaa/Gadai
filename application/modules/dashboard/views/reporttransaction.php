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
                Report Transaction - <span class="fw-normal">Dashboard</span>
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
                                            <label class="form-label">Customer:</label>
                                            <select name="Customer" data-placeholder="Select Customer" id="Customer" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <?php foreach ($activeCustomers as $row) { ?>
                                                    <option value="<?php echo $row['CustomerId'] ?>" <?php echo $this->session->flashdata('model')['customer'] == $row['CustomerId'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <label class="form-label">Item:</label>
                                            <select name="Item" data-placeholder="Select Item" id="Item" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <?php foreach ($activeItems as $row) { ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo $this->session->flashdata('model')['item'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?> (<?php echo $row['code'] ?>)</option>
                                                <?php } ?>
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
                        <div class="table-responsive">
                            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                                <h5 class="py-sm-2 my-sm-1">Transaction Data</h5>
                                <div class="mt-2 mt-sm-0 ms-sm-auto">
                                    <a id="btn-print" class="btn btn-sm btn-secondary">
                                        <i class="ph-printer ph-lg me-2"></i>
                                        Print Report
                                    </a>
                                </div>
                            </div>
                            <div>
                                <table class="table" id="table-listing">
                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th class="col-md-1">Date</th>
                                            <th class="col-md-2">Transaction Code</th>
                                            <th class="col-md-3">Customer</th>
                                            <th class="col-md-3">Item</th>
                                            <th class="col-md-1 text-right">Total</th>
                                            <th class="col-md-1 text-right">Charge</th>
                                            <th class="col-md-1 text-right">Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($dataTransactions) > 0) {
                                            $sumTotal = 0;
                                            $sumCharge = 0;
                                            $sumGrand = 0;
                                            foreach ($dataTransactions as $row) {
                                                $sumChargePayment = $this->DashboardModel->FindSumChargePaymentByTransactionId($row['TransactionId']);
                                        ?>
                                                <tr class="<?php echo $row['TransactionStatus'] == 2 ? "table-success" : ($row['TransactionStatus'] == 3 ? "table-danger" : ""); ?>">
                                                    <td class="col-md-1"><?php echo $row['date']; ?></td>
                                                    <td class="col-md-2"><?php echo $row['TransactionCode']; ?></td>
                                                    <td class="col-md-3"><?php echo $row['CustomerName']; ?></td>
                                                    <td class="col-md-3"><?php echo $row['ItemName'] . ' (' . $row['ItemCode'] . ')'; ?></td>
                                                    <td class="col-md-1" style="text-align: right;">Rp. <?php echo number_format($row['angsuran']); ?></td>
                                                    <td class="col-md-1" style="text-align: right;">Rp. <?php echo number_format($sumChargePayment->Charge); ?></td>
                                                    <td class="col-md-1" style="text-align: right;">Rp. <?php echo number_format($row['angsuran'] + $sumChargePayment->Charge); ?></td>
                                                </tr>
                                            <?php
                                                $sumTotal += $row['angsuran'];
                                                $sumCharge += $sumChargePayment->Charge;
                                                $sumGrand += $row['angsuran'] + $sumChargePayment->Charge;
                                            } ?>
                                            <tr class="table-dark">
                                                <td colspan="2"></td>
                                                <td colspan="2">Total</td>
                                                <td style="text-align: right;">Rp. <?php echo number_format($sumTotal); ?></td>
                                                <td style="text-align: right;">Rp. <?php echo number_format($sumCharge); ?></td>
                                                <td style="text-align: right;">Rp. <?php echo number_format($sumGrand); ?></td>
                                            </tr>
                                        <?php
                                        } else { ?>
                                            <tr>
                                                <td class="text-center" colspan="7">There is no data.</td>
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

<script>
    var baseURL = '<?php echo base_url() ?>dashboard/';
</script>
<script src="<?php echo base_url() ?>assets/js/dashboard/reports/transaction.js?v=20221227.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>