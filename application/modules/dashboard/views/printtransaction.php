<?php echo $this->load->view('print-layout'); ?>

<style>
    #table-header>tbody>tr>td {
        padding-top: .625rem !important;
        padding-bottom: .625rem !important;
    }
</style>

<?php
$payments = $this->DashboardModel->FindPaymentByTransactionId($selectedTransaction->TransactionId);
?>


<table id="table-header" style="width: 100%;">
    <tr>
        <td class="mb-1">Transaction Code</td>
        <td><?php echo $selectedTransaction->TransactionCode ?></td>
        <td>Item Name</td>
        <td><?php echo $selectedTransaction->ItemName ?></td>
    </tr>
    <tr>
        <td>Customer</td>
        <td><?php echo $selectedTransaction->CustomerName ?></td>
        <td>Item Code</td>
        <td><?php echo $selectedTransaction->ItemCode ?></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td><?php echo $selectedTransaction->TransactionNIK ?></td>
        <td>Address</td>
        <td><?php echo $selectedTransaction->TransactionAddress ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo $selectedTransaction->TransactionPhone ?></td>
        <td>Date</td>
        <td><?php echo $selectedTransaction->date ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td colspan="3"><?php echo $selectedTransaction->TransactionStatus == 1 ? 'Incompleted' : ($selectedTransaction->TransactionStatus == 2 ? 'Completed' : 'Cancelled'); ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td colspan="3"><?php echo $selectedTransaction->description ?></td>
    </tr>
    <tr>
        <td>GrandTotal</td>
        <td colspan="3">Rp. <?php echo number_format($selectedTransaction->angsuran) ?></td>
    </tr>
    <tr>
        <td>Pay</td>
        <td colspan="3"><?php echo $selectedTransaction->pay ?> month(s)</td>
    </tr>
</table>
<div class="table-responsive">
    <table class="table" id="table-details">
        <thead>
            <tr class="table-dark">
                <th class="col-md-2">Month</th>
                <th class="col-md-4">Due Date</th>
                <th class="col-md-4">Amount</th>
                <th class="col-md-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $month = 0;
            $dueDate = (new DateTime($selectedTransaction->date))->modify('+30 days')->format('Y-m-d');
            for ($idx = 1; $idx <= $selectedTransaction->pay; $idx++) {
                $status = $idx <= count($payments) ? "Paid" : "Unpaid";
                $month++; ?>
                <tr>
                    <th class="col-md-2"><?php echo $month; ?></th>
                    <th class="col-md-4"><?php echo $dueDate; ?></th>
                    <th class="col-md-4">Rp. <?php echo number_format($selectedTransaction->angsuran / $selectedTransaction->pay); ?></th>
                    <th class="col-md-2"><?php echo $status; ?></th>
                </tr>
            <?php
                $dueDate = (new DateTime($dueDate))->modify('+30 days')->format('Y-m-d');
            } ?>
        </tbody>
    </table>
</div>

<script>
    $(function() {
        window.print();
    });
</script>