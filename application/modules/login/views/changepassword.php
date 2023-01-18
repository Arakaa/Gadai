<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Gadai - Change Password</title>

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
                    <?php echo form_open('/login/changingpassword', array('class' => 'login-form needs-validation', 'novalidate' => '')); ?>
                    <?php echo $this->session->flashdata('Change_ResponseMessage'); ?>
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center" style="padding: 0 18px 0 18px;">
                            <div class="ms-auto">
                                <h3 class="mt-1"><a href="<?php echo base_url() ?>" class="btn-close text-body"></a></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                                    <i class="ph-arrows-counter-clockwise ph-2x"></i>
                                </div>
                                <h5 class="mb-0">Change Password</h5>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" name="OldPassword" class="form-control" placeholder="Enter Old Password" required>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" name="NewPassword" class="form-control" placeholder="Enter New Password" required>
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Change Password</button>
                            </div>

                            <div class="mb-3">
                                <a href="<?php echo base_url() ?>" class="btn btn-default w-100">Back</a>
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