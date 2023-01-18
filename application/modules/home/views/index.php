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
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/images/website/egadai.png">
</head>

<body>
    <!-- Nav Section -->
    <?php echo $this->load->view('nav-home'); ?>

    <div id="home" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#home" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#home" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#home" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo base_url() ?>/assets/images/website/slide1fix.png" alt="Yamashita Mizuki" class="img-fluid">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>/assets/images/website/slide2.png" class="img-fluid" alt="...">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo base_url() ?>/assets/images/website/slide3.png" class="img-fluid" alt="...">
                <div class="carousel-caption">

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    <!-- Services Section -->

    <!-- Services Section -->

    <section id="services" class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Kelebihan Layanan E-Gadai</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-subtract"></i>
                            <h3 class="card-title">Proses Mudah dan Cepat</h3>
                            <p class="lead">Proses gadai dilakukan secara mudah, cukup lakukan registrasi dan datang ke Pegadaian untuk melakukan taksiran barang </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-subtract"></i>
                            <h3 class="card-title">Harga Sesuai</h3>
                            <p class="lead">Harga yang diberikan akan disesuaikan dengan kualitas, nilai jual dan jenis barang yang digadaikan</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-dark pb-2">
                        <div class="card-body">
                            <i class="bi bi-subtract"></i>
                            <h3 class="card-title">Mudah diakses</h3>
                            <p class="lead">Layanan bisa di akses lewat website kapanpun dan dimanapun, monitoring angsuran secara online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->

    <section id="portfolio" class="portfolio section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Informasi Pegadaian</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="<?php echo base_url() ?>/assets/images/website/syarat.png" alt="Yamashita Mizuki" class="img-fluid">
                            </div>
                            <h3 class="card-title">Persyaratan umum</h3>
                            <p class="list">1. Fotocopy KTP</p>
                            <p class="list">2. Fotocopy Kartu Keluarga</p>
                            <p class="list">3. Membawa barang atau surat kepemilikan barang</p>
                            <p class="list">4. Menyetujui semua kebijakan yang berlaku</p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="<?php echo base_url() ?>/assets/images/website/barang.png" alt="Yamashita Mizuki" class="img-fluid">
                            </div>
                            <h3 class="card-title">Apa saja yang bisa di gadai ?</h3>
                            <p class="list">1. Emas</p>
                            <p class="list">2. Kendaraan</p>
                            <p class="list">3. Barang elektronik</p>
                            <p class="list">4. Sertifikat tanah</p>
                            <p class="list">5. Dan sebagainya</p>

                        </div>
                    </div>
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
</body>

</html>