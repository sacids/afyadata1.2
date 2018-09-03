<!-- Page content -->
<div class="page-content">
    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="<?= base_url('global_assets/images/placeholders/placeholder.jpg') ?>"
                                             width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold">Victoria Baker</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                        <i class="icon-menu" title="Main"></i></li>
                    <li class="nav-item">
                        <a href="<?= site_url('dashboard') ?>" class="nav-link active">
                            <i class="icon-home4"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Projects</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item"><?= anchor('projects/create', 'Create New', 'class="nav-link"') ?></li>
                            <?php show_projects() ?>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-archive"></i> <span>OHKR</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item"><a href="<?= site_url('ohkr/diseases/lists') ?>" class="nav-link">Diseases</a>
                            </li>
                            <li class="nav-item"><a href="<?= site_url('ohkr/symptoms/lists') ?>" class="nav-link">Symptoms</a>
                            </li>
                            <li class="nav-item"><a href="<?= site_url('ohkr/species/lists') ?>" class="nav-link">Species</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-user-lock"></i> <span>Permissions</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Themes">
                            <li class="nav-item"><a href="index.html" class="nav-link active">Default</a></li>
                        </ul>
                    </li>

                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Manage Users</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item"><a href="<?= site_url('auth/users_lists') ?>" class="nav-link">Users
                                    List</a></li>
                            <li class="nav-item"><a href="<?= site_url('auth/groups_lists') ?>" class="nav-link">Groups
                                    List</a></li>
                        </ul>
                    </li>
                    <!-- /page kits -->

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->