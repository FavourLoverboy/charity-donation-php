<?php include('includes/header.php');?>
<?php 

    $_SESSION['ref_code'] = $_GET['ref'];
    echo "<script>  window.location='reg.php' </script>";

?>
<?php include ('includes/footer.php');?>