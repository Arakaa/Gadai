<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Gadai - Forgot Password</title>

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
                    <?php echo form_open('/login/recoverpassword', array('class' => 'login-form')); ?>
                    <?php echo $this->session->flashdata('Forgot_ResponseMessage'); ?>
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                                    <i class="ph-arrows-counter-clockwise ph-2x"></i>
                                </div>
                                <h5 class="mb-0">Password recovery</h5>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Your email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="email" name="Email" class="form-control" required placeholder="Enter Email">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-at text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ph-arrow-counter-clockwise me-2"></i>
                                Reset password
                            </button>

                            <a href="<?php echo base_url() ?>login" class="btn btn-default w-100">
                                Back
                            </a>
                        </div>
                    </div>
                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>