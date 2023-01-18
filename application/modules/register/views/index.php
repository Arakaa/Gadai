<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>E-Gadai - Customer Register</title>

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
	<script src="<?php echo base_url() ?>assets/limitless/assets/demo/pages/form_layouts.js"></script>
	<!-- /theme JS files-->

	<style>
		.select2 {
			padding: 0px !important;
		}
	</style>
</head>

<body>
	<div class="content-wrapper">
		<div class="content-inner">
			<div class="content">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="card">
							<div class="card-header">
								<h5 class="mb-0 text-center">Customer Register</h5>
							</div>
							<div class="card-body">
								<?php echo form_open('/register/doregister', array('id' => 'myform')) ?>
								<?php echo $this->session->flashdata('Register_ResponseMessage'); ?>
								<fieldset class="mb-3">
									<legend class="fs-base fw-bold border-bottom pb-2 mb-3">Biodata</legend>

									<div class="row mb-3">
										<label class="form-label">Nama:</label>
										<input type="text" name="Name" class="form-control" placeholder="Masukkan Nama">
									</div>

									<div class="row mb-3">
										<label class="form-label">NIK:</label>
										<input type="text" name="NIK" class="form-control" placeholder="Masukkan NIK">
									</div>

									<div class="row mb-3">
										<label class="form-label">Nomor Telepon:</label>
										<input type="text" name="PhoneNumber" class="form-control numeric-custom" placeholder="Masukkan Nomor Telepon Aktif">
									</div>

									<div class="row mb-3">
										<label class="form-label">Jenis Kelamin:</label>
										<select name="Gender" data-placeholder="Pilih Jenis Kelamin" class="form-control-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" style="padding: 0px !important;">
											<option selected disabled></option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>

									<div class="row mb-3">
										<label class="form-label">Alamat:</label>
										<textarea name="Address" rows="3" cols="3" class="form-control" placeholder="Masukkan Alamat"></textarea>
									</div>
								</fieldset>

								<fieldset class="mb-3">
									<legend class="fs-base fw-bold border-bottom pb-2 mb-3">Akun</legend>

									<div class="row mb-3">
										<label class="form-label">Email:</label>
										<input name="Email" type="text" class="form-control" placeholder="Masukkan Email">
									</div>

									<div class="row mb-3">
										<label class="form-label">Password:</label>
										<input name="Password" type="password" class="form-control" placeholder="Masukkan Password">
									</div>

									<div class="row mb-3">
										<label class="form-label">Konfirmasi Password:</label>
										<input name="ConfirmationPassword" type="password" class="form-control" placeholder="Masukkan Konfirmasi Password">
									</div>

									<div class="text-end">
										<a href="<?php echo base_url() ?>login" class="btn btn-default">Back</a>
										<button type="button" class="btn btn-primary btn-submit">Register</button>
									</div>
								</fieldset>
								<?php form_close() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	var baseURL = '<?php echo base_url(); ?>';
	$(document).on('keydown keypress keyup', '.numeric-custom', function(e) {
		if (e.key == "+") {
			return;
		}
		// Allow: backspace, delete, tab, escape, enter and .
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 187]) !== -1 ||
			// Allow: Ctrl/cmd+A
			(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
			// Allow: Ctrl/cmd+C
			(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
			// Allow: Ctrl/cmd+X
			(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
			// Allow: home, end, left, right
			(e.keyCode >= 35 && e.keyCode <= 39)) {
			// let it happen, don't do anything
			return;
		}
		// Ensure that it is a number and stop the keypress
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105 || e.keyCode == 190)) {
			e.preventDefault();
		}
	});
</script>
<script src="<?php echo base_url() ?>/assets/js/website/register/!general.js?20221219.1"></script>

</html>