<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-expand-lg sidebar-main-resized align-self-start">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item pb-3">
                    <a href="<?php echo base_url() ?>dashboard" class="nav-link">
                        <i class="ph-house"></i>
                        <span>
                            Dashboard
                            <!-- <span class="d-block fw-normal text-body opacity-50">No pending orders</span> -->
                        </span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="../../../../docs/other_changelog.html" class="nav-link">
                        <i class="ph-list-numbers"></i>
                        <span>Changelog</span>
                        <span class="badge bg-primary align-self-center rounded-pill ms-auto">4.0</span>
                    </a>
                </li> -->

                <!-- Masters -->
                <li class="nav-item-header">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Masters</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url() ?>dashboard/customer" class="nav-link">
                        <i class="ph-user"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="nav-item pb-3">
                    <a href="<?php echo base_url() ?>dashboard/item" class="nav-link">
                        <i class="ph-archive-box"></i>
                        <span>Item</span>
                    </a>
                </li>

                <!-- Transactions -->
                <li class="nav-item-header">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Transactions</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item pb-3">
                    <a href="<?php echo base_url() ?>dashboard/transaction" class="nav-link">
                        <i class="ph-note"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <li class="nav-item-header">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Reports</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link">
                        <i class="ph-newspaper"></i>
                        <span>Masters</span>
                    </a>

                    <ul class="nav-group-sub collapse" data-submenu-title="Masters">
                        <li class="nav-item"><a href="<?php echo base_url() ?>dashboard/reportcustomer" class="nav-link">Customer Report</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu pb-3">
                    <a href="#" class="nav-link">
                        <i class="ph-newspaper"></i>
                        <span>Transactions</span>
                    </a>

                    <ul class="nav-group-sub collapse" data-submenu-title="Transactions">
                        <li class="nav-item"><a href="<?php echo base_url() ?>dashboard/reporttransaction" class="nav-link">Transaction Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->


<!-- Secondary sidebar -->
<!-- <div class="sidebar sidebar-secondary sidebar-expand-lg align-self-start"> -->

<!-- Sidebar content -->
<!-- <div class="sidebar-content"> -->

<!-- Header -->
<!-- <div class="sidebar-section sidebar-section-body d-flex align-items-center pb-1">
                <h5 class="mb-0">Sidebar</h5>
                <div class="ms-auto">
                    <button type="button" class="btn btn-light border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-secondary-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div> -->
<!-- /header -->


<!-- Sidebar search -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Sidebar search</span>
                    <div class="ms-auto">
                        <a href="#sidebar-search" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-search">
                    <div class="sidebar-section-body">
                        <div class="form-control-feedback form-control-feedback-end">
                            <input type="search" class="form-control" placeholder="Search">
                            <div class="form-control-feedback-icon">
                                <i class="ph-magnifying-glass opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
<!-- /sidebar search -->


<!-- Actions -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Actions</span>
                    <div class="ms-auto">
                        <a href="#sidebar-actions" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-actions">
                    <div class="sidebar-section-body">
                        <div class="row row-tile g-0">
                            <div class="col">
                                <button type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
                                    <i class="ph-app-store-logo text-primary ph-2x mb-1"></i>
                                    App store
                                </button>

                                <button type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-start py-2">
                                    <i class="ph-twitter-logo text-info ph-2x mb-1"></i>
                                    Twitter
                                </button>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-end py-2">
                                    <i class="ph-dribbble-logo text-pink ph-2x mb-1"></i>
                                    Dribbble
                                </button>

                                <button type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
                                    <i class="ph-spotify-logo text-success ph-2x mb-1"></i>
                                    Spotify
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
<!-- /actions -->


<!-- Sub navigation -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Navigation</span>
                    <div class="ms-auto">
                        <a href="#sidebar-navigation" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-navigation">
                    <ul class="nav nav-sidebar my-2" data-nav-type="accordion">
                        <li class="nav-item-header opacity-50">Actions</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-plus-circle me-3"></i>
                                Create task
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-circles-three-plus me-3"></i>
                                Create project
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-pencil me-3"></i>
                                Edit task list
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-user-plus me-3"></i>
                                Assign users
                                <span class="badge bg-primary rounded-pill ms-auto">94 online</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-users-three me-3"></i>
                                Create team
                            </a>
                        </li>
                        <li class="nav-item-header opacity-50">Navigate</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-kanban me-3"></i>
                                All tasks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-file-plus"></i>
                                Active tasks
                                <span class="badge bg-dark rounded-pill ms-auto">28</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-file-x me-3"></i>
                                Closed tasks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-user-focus me-3"></i>
                                Assigned to me
                                <span class="badge bg-info rounded-pill ms-auto">86</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-folder-user me-3"></i>
                                Assigned to my team
                                <span class="badge bg-danger rounded-pill ms-auto">47</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="ph-gear me-3"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
<!-- /sub navigation -->


<!-- Online users -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Users online</span>
                    <div class="ms-auto">
                        <a href="#sidebar-users" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-users">
                    <div class="sidebar-section-body">
                        <div class="d-flex mb-3">
                            <a href="#" class="me-3">
                                <img src="<?php echo base_url() ?>assets/limitless/assets/images/demo/users/face1.jpg" width="36" height="36" class="rounded-pill" alt="">
                            </a>
                            <div class="flex-fill">
                                <a href="#" class="fw-semibold">James Alexander</a>
                                <div class="fs-sm opacity-50">Santa Ana, CA.</div>
                            </div>
                            <div class="ms-3 align-self-center">
                                <div class="bg-success border-success rounded-pill p-1"></div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <a href="#" class="me-3">
                                <img src="<?php echo base_url() ?>assets/limitless/assets/images/demo/users/face2.jpg" width="36" height="36" class="rounded-pill" alt="">
                            </a>
                            <div class="flex-fill">
                                <a href="#" class="fw-semibold">Jeremy Victorino</a>
                                <div class="fs-sm opacity-50">Dowagiac, MI.</div>
                            </div>
                            <div class="ms-3 align-self-center">
                                <div class="bg-danger border-danger rounded-pill p-1"></div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <a href="#" class="me-3">
                                <img src="<?php echo base_url() ?>assets/limitless/assets/images/demo/users/face3.jpg" width="36" height="36" class="rounded-pill" alt="">
                            </a>
                            <div class="flex-fill">
                                <a href="#" class="fw-semibold">Margo Baker</a>
                                <div class="fs-sm opacity-50">Kasaan, AK.</div>
                            </div>
                            <div class="ms-3 align-self-center">
                                <div class="bg-success border-success rounded-pill p-1"></div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <a href="#" class="me-3">
                                <img src="<?php echo base_url() ?>assets/limitless/assets/images/demo/users/face4.jpg" width="36" height="36" class="rounded-pill" alt="">
                            </a>
                            <div class="flex-fill">
                                <a href="#" class="fw-semibold">Beatrix Diaz</a>
                                <div class="fs-sm opacity-50">Neenah, WI.</div>
                            </div>
                            <div class="ms-3 align-self-center">
                                <div class="bg-warning border-warning rounded-pill p-1"></div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="#" class="me-3">
                                <img src="<?php echo base_url() ?>assets/limitless/assets/images/demo/users/face5.jpg" width="36" height="36" class="rounded-pill" alt="">
                            </a>
                            <div class="flex-fill">
                                <a href="#" class="fw-semibold">Richard Vango</a>
                                <div class="fs-sm opacity-50">Grapevine, TX.</div>
                            </div>
                            <div class="ms-3 align-self-center">
                                <div class="bg-secondary border-secondary rounded-pill p-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
<!-- /online-users -->


<!-- Filter -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Filters</span>
                    <div class="ms-auto">
                        <a href="#sidebar-filters" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-filters">
                    <div class="sidebar-section-body">
                        <label class="form-check form-check-reverse text-start mb-2">
                            <input type="checkbox" class="form-check-input" checked>
                            <span class="form-check-label">Canon</span>
                        </label>

                        <label class="form-check form-check-reverse text-start mb-2">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label">Nikon</span>
                        </label>

                        <label class="form-check form-check-reverse text-start mb-2">
                            <input type="checkbox" class="form-check-input" checked>
                            <span class="form-check-label">Sony</span>
                        </label>

                        <label class="form-check form-check-reverse text-start mb-2">
                            <input type="checkbox" class="form-check-input" checked>
                            <span class="form-check-label">Fuji</span>
                        </label>

                        <label class="form-check form-check-reverse text-start">
                            <input type="checkbox" class="form-check-input">
                            <span class="form-check-label">Leica</span>
                        </label>
                    </div>
                </div>
            </div> -->
<!-- /filter -->


<!-- Latest updates -->
<!-- <div class="sidebar-section">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Latest updates</span>
                    <div class="ms-auto">
                        <a href="#sidebar-updates" class="text-reset" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator"></i>
                        </a>
                    </div>
                </div>

                <div class="collapse show" id="sidebar-updates">
                    <div class="sidebar-section-body">
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <div class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2">
                                    <i class="ph-git-pull-request"></i>
                                </div>
                            </div>

                            <div class="flex-fill">
                                Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                <div class="fs-sm opacity-50">4 minutes ago</div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <div class="bg-warning bg-opacity-10 text-warning lh-1 rounded-pill p-2">
                                    <i class="ph-git-commit"></i>
                                </div>
                            </div>

                            <div class="flex-fill">
                                Add full font overrides for popovers and tooltips
                                <div class="fs-sm opacity-50">36 minutes ago</div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <div class="bg-info bg-opacity-10 text-info lh-1 rounded-pill p-2">
                                    <i class="ph-git-branch"></i>
                                </div>
                            </div>

                            <div class="flex-fill">
                                <a href="#">Chris Arney</a> created a new <span class="fw-semibold">Design</span> branch
                                <div class="fs-sm opacity-50">2 hours ago</div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <div class="bg-success bg-opacity-10 text-success lh-1 rounded-pill p-2">
                                    <i class="ph-git-merge"></i>
                                </div>
                            </div>

                            <div class="flex-fill">
                                <a href="#">Eugene Kopyov</a> merged <span class="fw-semibold">Master</span> and <span class="fw-semibold">Dev</span> branches
                                <div class="fs-sm opacity-50">Dec 18, 18:36</div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="me-3">
                                <div class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2">
                                    <i class="ph-git-pull-request"></i>
                                </div>
                            </div>

                            <div class="flex-fill">
                                Have Carousel ignore keyboard events
                                <div class="fs-sm opacity-50">Dec 12, 05:46</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
<!-- /latest updates -->

<!-- </div> -->
<!-- /sidebar content -->

<!-- </div> -->
<!-- /secondary sidebar -->