<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><span >E-Gadai</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
        </li>
        <?php if ($this->session->userdata('customerId')) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>transaction">Transaction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>login/changepassword">Change Password</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <?php if (!$this->session->userdata('customerId')) { ?>
            <a class="nav-link" href="<?php echo base_url() ?>login">Sign In</a>
          <?php } else { ?>
            <a class="nav-link" href="<?php echo base_url() ?>login/dologout">Sign Out</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>