<?php echo $this->load->view('print-layout'); ?>

<table class="table" id="table-listing">
    <thead>
        <tr class="bg-dark text-white">
            <th class="col-md-1 text-center">Date</th>
            <th class="col-md-2 text-center">Transaction Code</th>
            <th class="col-md-3 text-center">Customer</th>
            <th class="col-md-3 text-center">Item</th>
            <th class="col-md-1">Total</th>
            <th class="col-md-1">Charge</th>
            <th class="col-md-1">Grand Total</th>
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
                <td class="text-right">Rp. <?php echo number_format($sumTotal); ?></td>
                <td class="text-right">Rp. <?php echo number_format($sumCharge); ?></td>
                <td class="text-right">Rp. <?php echo number_format($sumGrand); ?></td>
            </tr>
        <?php
        } else { ?>
            <tr>
                <td class="text-center" colspan="5">There is no data.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(function() {
        window.print();
    });
</script>