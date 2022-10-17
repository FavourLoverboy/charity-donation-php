<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <!-- <img class="img-responsive good" id="goodie" style="display:none;" src="assets/logoSm.png" alt="Grypton's Icon"> -->
            <img class="img-responsive d-none d-md-block responding" id="respond" src="assets/logo.png" alt="COIN-DRIFTFX's Icon">
            <!-- <img class="img-responsive d-md-none" src="assets/logoSm.png" alt="COIN-DRIFTFX's Icon"> -->
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $active4;?>">
        <a class="nav-link" href="<?php echo $url[0], '/dashboard';?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php 
        if($_SESSION['role'] == '1'){
            include('more/admin.php');
        }else{
            include('more/user.php');
        }
    ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo $url[0], '/setting';?>">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span>Setting</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout.php">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="hide(),show()"></button>
    </div>
</ul>
<!-- End of Sidebar -->

