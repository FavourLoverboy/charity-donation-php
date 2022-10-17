<?php
    session_start();
    if(!$_SESSION['u_name']){
        header('location: login.php');
    }

    $admin = 'admin';
    $user = 'user';

    if($_SESSION['role'] == '1'){
        if($url[0] != $admin){
            echo "<script>  window.location='/charity-donation-php/admin/dashboard' </script>";
        }
    }elseif($_SESSION['role'] == '0'){
        if($url[0] != $user){
            echo "<script>  window.location='/charity-donation-php/user/dashboard' </script>";
        }
    }
?>

<?php include('includes/header.php'); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include ('includes/sidebar.php'); ?>
        <?php include ('includes/more/admin_title.php'); ?>
        <?php include ('includes/more/user_title.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include ('includes/topbar.php'); ?>
                <?php include($page); ?>
                <?php include ('includes/bottombar.php'); ?>
            </div>
        </div>
    </div>
<?php include ('includes/footer.php'); ?>