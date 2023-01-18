<?php echo $this->load->view('print-layout'); ?>


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

<script>
    $(function() {
        window.print();
    });
</script>