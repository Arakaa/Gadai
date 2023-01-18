<?php echo $this->load->view('dashboard-layout'); ?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Dashboard</span>
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


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content">

            <!-- Dashboard content -->
            <div class="row">
                <div class="col-xl-8">
                    <!-- Quick stats boxes -->
                    <div class="row">
                        <div class="col-lg-4">

                            <!-- Members online -->
                            <div class="card bg-teal text-white">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h3 class="mb-0"><?php echo number_format($customerCount, 0) ?></h3>
                                        <div class="ms-auto">
                                            <a class="text-white">
                                                <i class="ph-user"></i>
                                            </a>
                                        </div>
                                        <!-- <span class="badge bg-black bg-opacity-50 rounded-pill align-self-center ms-auto">+53,6%</span> -->
                                    </div>

                                    <div>
                                        Customer Registrations
                                        <div class="fs-sm opacity-75">This month: <?php echo number_format($customerCountMonthly, 0) ?></div>
                                    </div>
                                </div>

                                <!-- <div class="rounded-bottom overflow-hidden mx-3" id="members-online"></div> -->
                            </div>
                            <!-- /members online -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Current server load -->
                            <div class="card bg-pink text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mb-0">Rp. <?php echo number_format($totalUnpaidTransactions); ?></h3>
                                        <div class="ms-auto">
                                            <a class="text-white">
                                                <i class="ph-note"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        Unpaid Transactions
                                        <div class="fs-sm opacity-75">This month: Rp. <?php echo number_format($totalMonthlyUnpaidTransactions) ?></div>
                                    </div>
                                </div>
                                <!-- <div class="rounded-bottom overflow-hidden" id="server-load"></div> -->
                            </div>
                            <!-- /current server load -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Today's revenue -->
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h3 class="mb-0">Rp. <?php echo number_format($totalTodaysRevenue); ?></h3>
                                        <div class="ms-auto">
                                            <a class="text-white">
                                                <i class="ph-money"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        Today's revenue
                                        <div class="fs-sm opacity-75">This month: Rp. <?php echo number_format($totalMonthlyRevenue); ?></div>
                                    </div>
                                </div>

                                <!-- <div class="rounded-bottom overflow-hidden" id="today-revenue"></div> -->
                            </div>
                            <!-- /today's revenue -->

                        </div>
                    </div>
                    <!-- /quick stats boxes -->


                    <!-- Support tickets -->
                    <div class="card">
                        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                            <h5 class="py-sm-2 my-sm-1">
                                Due Transactions (in 7 days)
                            </h5>
                            <div class="mt-2 mt-sm-0 ms-sm-auto">
                                <span class="badge bg-primary rounded-pill"><?php echo count($comingTransactions); ?></span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">Due</th>
                                        <th style="width: 300px;">Customer</th>
                                        <th>Description</th>
                                        <th class="text-center" style="width: 20px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($comingTransactions) > 0) {
                                        foreach ($comingTransactions as $row) {
                                            $findCustomer = $this->DashboardModel->FindCustomer($row['customer_id']);
                                            $labelStatus = $row['status_payment'] == 1 ? "Unpaid" : ($row['status_payment'] == 2 ? "Partial Paid" : "Paid");
                                            $classStatus = $row['status_payment'] == 1 ? "bg-danger" : ($row['status_payment'] == 2 ? "bg-warning" : "bg-success");
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="text-due-transaction" data-pay="<?php echo $row['pay'] ?>" data-date="<?php echo $row['date'] ?>"></div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!-- <a href="#" class="d-inline-flex align-items-center justify-content-center bg-teal text-white lh-1 rounded-pill w-40px h-40px me-3">
                                                        <span class="letter-icon"></span>
                                                    </a> -->
                                                        <div>
                                                            <a href="#" class="text-body fw-semibold letter-icon-title"><?php echo $findCustomer->name; ?></a>
                                                            <!-- <div class="d-flex align-items-center text-muted fs-sm">
                                                            <span class="bg-danger rounded-pill p-1 me-2"></span>
                                                            Blocker
                                                        </div> -->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-body">
                                                        <div class="fw-semibold">[<?php echo $row['code'] ?>] The invoice for the month of <span class="text-period-due">January 2023</span></div>
                                                        <span class="text-muted"><?php echo $row['description'] ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge <?php echo $classStatus ?>"><?php echo $labelStatus ?></span>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="4">There is no data.</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /support tickets -->
                </div>

                <div class="col-xl-4">

                    <!-- Daily financials -->
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="mb-0">Daily registrations</h5>
                        </div>

                        <div class="card-body">
                            <div class="chart mb-3" id="bullets"></div>
                            <?php
                            foreach ($dailyRegistration as $row) {
                                $isActive = $row['status'];
                            ?>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <div class="<?php echo $isActive == 1 ? 'bg-success text-success' : 'bg-danger text-danger' ?> bg-opacity-10 lh-1 rounded-pill p-2">
                                            <i class="ph-users"></i>
                                        </div>
                                    </div>
                                    <div class="flex-fill">
                                        Customer <a href="#" class="text-dark"><span class="fw-semibold"><?php echo $row['name'] ?></span></a> has been registered
                                        <div class="text-muted fs-sm text-ago" data-created="<?php echo $row['created_at'] ?>">36 minutes ago</div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /daily financials -->

                </div>
            </div>
            <!-- /dashboard content -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

<script src="<?php echo base_url() ?>assets/js/dashboard/index/index.js?v=20221222.1"></script>
<?php echo $this->load->view('dashboard-footer'); ?>