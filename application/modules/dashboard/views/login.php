<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Gadai - Dashboard</title>

    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/images/website/egadai.png">

    <!-- Global stylesheets -->
    <link href="<?php echo base_url() ?>assets/limitless/assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>assets/limitless/assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>assets/limitless/assets/css/ltr/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?php echo base_url() ?>assets/limitless/assets/demo/demo_configurator.js"></script>
    <script src="<?php echo base_url() ?>assets/limitless/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo base_url() ?>assets/limitless/assets/js/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/limitless/assets/js/vendor/forms/selects/select2.min.js"></script>

    <script src="<?php echo base_url() ?>assets/limitless/assets/js/app.js"></script>
    <script src="<?php echo base_url() ?>assets/limitless/assets/demo/pages/form_validation_styles.js"></script>
    <!-- /theme JS files-->

    <style>
        .select2 {
            padding: 0px !important;
        }
    </style>
</head>

<body>
    <div class="page-content">

        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center" style="padding: 100px">
                    <!-- Login form -->
                    <?php echo form_open('/dashboard/dologin', array('class' => 'login-form needs-validation', 'novalidate' => '')); ?>
                    <?php echo $this->session->flashdata('Login_ResponseMessage'); ?>
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center" style="padding: 0 18px 0 18px;">
                            <div class="ms-auto">
                                <h3 class="mt-1"><a href="<?php echo base_url() ?>" class="btn-close text-body"></a></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                    <img src="<?php echo base_url() ?>assets/limitless/assets/images/logo_icon.svg" class="h-48px" alt="">
                                </div>
                                <h5 class="mb-0">Admin Login</h5>
                                <span class="d-block text-muted">Enter your credentials below</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" name="Email" class="form-control" placeholder="Enter Email" required>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" name="Password" class="form-control" placeholder="Enter Password" required>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Sign in</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <!-- /login form -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>