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
                Report Customer - <span class="fw-normal">Dashboard</span>
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
                                            <label class="form-label">Customer:</label>
                                            <select name="Customer" data-placeholder="Select Customer" id="Customer" class="form-control-select2 select2-hidden-accessible" data-allow-clear="true" tabindex="-1" aria-hidden="true">
                                                <option selected disabled></option>
                                                <?php foreach ($activeCustomers as $row) { ?>
                                                    <option value="<?php echo $row['CustomerId'] ?>" <?php echo $this->session->flashdata('model')['customer'] == $row['CustomerId'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success mt-4 btn-filter">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                                <h5 class="py-sm-2 my-sm-1">Customer Data</h5>
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
                                            <th class="col-md-3">Customer</th>
                                            <th class="col-md-3">Status</th>
                                            <th class="col-md-1" style="text-align: right;">Total Paid</th>
                                            <th class="col-md-1" style="text-align: right;">Grandtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (count($dataCustomers) > 0) {
                                            $sumTotal = 0;
                                            $sumGrand = 0;
                                            foreach ($dataCustomers as $row) {
                                                $sumChargePayment = $this->DashboardModel->GetSumTotalPaymentByCustomer($row['CustomerId']);
                                                $totalPaid = $sumChargePayment->SumPay ?? 0;
                                                $grand = $row['SumGrandtotal'];
                                                $status = number_format($totalPaid) == number_format($grand) ? "Completed" : "Incompleted";
                                                $statusPayment = $totalPaid == 0 ? "Unpaid" : (number_format($totalPaid) == number_format($grand) ? "Paid" : "Partial"); ?>
                                                <tr class="<?php echo $statusPayment == "Paid" ? "table-success" : "" ?>">
                                                    <td class="col-md-3"><?php echo $row['name']; ?></td>
                                                    <td class="col-md-1"><?php echo $status; ?> (<?php echo $statusPayment; ?>)</td>
                                                    <td class="col-md-1" style="text-align: right;">Rp. <?php echo number_format($totalPaid); ?></td>
                                                    <td class="col-md-1" style="text-align: right;">Rp. <?php echo number_format($grand); ?></td>
                                                </tr>
                                            <?php
                                                $sumTotal += $totalPaid;
                                                $sumGrand += $grand;
                                            } ?>
                                            <tr class="table-dark">
                                                <td colspan="2" style="text-align: center;">Total</td>
                                                <td style="text-align: right;">Rp. <?php echo number_format($sumTotal); ?></td>
                                                <td style="text-align: right;">Rp. <?php echo number_format($sumGrand); ?></td>
                                            </tr>
                                        <?php
                                        } else { ?>
                                            <tr>
                                                <td class="text-center" colspan="3">There is no data.</td>
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
<script src="<?php echo base_url() ?>assets/js/dashboard/reports/customer.js?v=20221228.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>