<div class="navbar navbar-dark navbar-expand-lg">
	<div class="container-fluid">
		<div class="d-flex d-lg-none me-2">
			<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
				<i class="ph-list"></i>
			</button>
			<button type="button" class="navbar-toggler sidebar-mobile-secondary-toggle rounded-pill">
				<i class="ph-arrow-left"></i>
			</button>
		</div>

		<div class="navbar-brand flex-1 flex-lg-0 d-none d-sm-flex">
			<a href="<?php echo base_url() ?>dashboard" class="d-inline-flex align-items-center">
				<img src="<?php echo base_url() ?>/assets/images/website/egadai.png" style="height: 40px;">
				<h3 class="d-none d-sm-inline-block h-16px ms-3 text-white">E-Gadai</h3>
			</a>
		</div>

		<ul class="nav flex-row justify-content-end order-1 order-lg-2">
			<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
				<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
					<span class="w-40px h-40px rounded-pill align-items-center d-inline-flex bg-yellow bg-opacity-80 text-white"></span>
					<span class="d-none d-lg-inline-block mx-lg-2"><?php echo $this->session->userdata('email') ?? "Admin"; ?></span>
				</a>

				<div class="dropdown-menu dropdown-menu-end">
					<a href="<?php echo base_url() ?>dashboard/dologout" class="dropdown-item">
						<i class="ph-sign-out me-2"></i>
						Logout
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>