<?php 
        include("includes/header.php");
         if($_SESSION['accessType'] == "User"){
            $link = "dashboard";
        }
        if($_SESSION['accessType'] == "Admin"){
            $link = "amdashboard";
        }
?>
    
    <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Page Not Found</p>
                        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                        <a href="<?php echo $link;?>">&larr; Back to Dashboard</a>
                    </div>

                </div>

                <?php include("includes/footer.php");?>