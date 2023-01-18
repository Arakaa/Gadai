<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/website/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/website/style.css">
    <title>E-Gadai</title>
    <style>
        .row-master {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Nav Section -->
    <?php echo $this->load->view('nav-home'); ?>
    <!-- Services Section -->

    <section id="services" class="services section-padding" style="min-height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table text-center">
                        <tr class="table-dark">
                            <th></th>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Transaksi</th>
                            <th>Barang</th>
                            <th>Angsuran</th>
                            <th>Status</th>
                        </tr>
                        <?php $no = 0;
                        $sumTotal = 0;
                        $hasData = false;
                        $today = (new DateTime('00:00'));
                        if (count($transactionCustomer) > 0) {
                            $hasData = true;
                            foreach ($transactionCustomer as $row) {
                                $no++;
                                $penaltyCount = 0;
                                $sumTotal += $row['angsuran'];
                                $idTransaction = $row['TransactionId'];
                                $payments = $this->TransactionModel->FindPaymentByTransactionId($idTransaction);
                                $sumChargePayment = $this->TransactionModel->FindSumChargePaymentByTransactionId($idTransaction);
                                $status = $row['TransactionStatus'] == 1 ? 'Incompleted' : ($row['TransactionStatus'] == 2 ? 'Completed' : 'Cancelled'); ?>
                                <tr class="table-warning row-master" data-id="<?php echo $idTransaction; ?>">
                                    <td>+</td>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['TransactionCode']; ?></td>
                                    <td><?php echo $row['ItemName']; ?> (<?php echo $row['ItemCode']; ?>)</td>
                                    <td>Rp. <?php echo number_format($row['angsuran']); ?></td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                                <tr class="row-<?php echo $idTransaction; ?> table-secondary d-none">
                                    <th></th>
                                    <th>Bulan</th>
                                    <th colspan="2">Jatuh Tempo</th>
                                    <th colspan="2">Jumlah Bayar</th>
                                    <th>Status</th>
                                </tr>
                                <?php for ($idx = 1; $idx <= $row['pay']; $idx++) {
                                    $dueDate = (new DateTime($row['date']))->modify('+' . ($idx * 30) . ' days')->format('Y-m-d');
                                    $isPaid = $idx <= count($payments);
                                    $diff = date_diff($today, date_create($dueDate));
                                    if ($diff->format("%R%a") < 0) $penaltyCount += $diff->format("%R%a");
                                ?>
                                    <tr class="row-<?php echo $idTransaction; ?> d-none">
                                        <td></td>
                                        <td><?php echo $idx; ?></td>
                                        <td colspan="2"><?php echo $dueDate; ?></td>
                                        <td colspan="2">Rp. <?php echo number_format($row['angsuran'] / $row['pay']); ?></td>
                                        <td><?php echo $isPaid ? "Sudah dibayar" : "Belum dibayar"; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="row-<?php echo $idTransaction; ?> table-danger d-none">
                                    <td colspan="4">Charge</td>
                                    <td colspan="2">Rp. <?php echo number_format((-1 * $penaltyCount) * 5000); ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7">Tidak ada data.</td>
                            </tr>
                        <?php } ?>
                        <tr class="table-dark">
                            <td colspan="5">Total</td>
                            <td>Rp. <?php echo number_format($sumTotal); ?></td>
                            <td></td>
                        </tr>
                    </table>
                    <?php if ($hasData) { ?>
                        <label class="label text-danger">*Total nominal di atas belum termasuk Charge</label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->

    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white">All Right Reserved @E-Gadai</p>
        </div>
    </footer>

    <script src="<?php echo base_url() ?>/assets/js/website/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/website/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/website/script.js"></script>
    <script>
        $('tr.row-master').on('click', function() {
            var id = $(this).data('id');
            var details = $('.row-' + id);
            if (details.hasClass('d-none')) {
                details.removeClass('d-none');
                $(this).find('td').eq(0).text('-');
            } else {
                details.addClass('d-none');
                $(this).find('td').eq(0).text('+');
            }
        });
    </script>
</body>

</html>