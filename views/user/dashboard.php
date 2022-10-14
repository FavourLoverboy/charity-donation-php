<?php
        // if($_SESSION['accessType'] == "Admin"){
        //     echo "<script>window.location='dashboard'</script>";
        // } 

        // $tblquery = "SELECT * FROM tbl_uploads WHERE upd_user = :email";
        // $tblvalue = array(
        //     ':email' => $_SESSION['email']
        // );
        // $select =$connect->tbl_select($tblquery, $tblvalue);
        // if($select){
        //     $disable = "disabled"; 
        // }
        // foreach($select as $data){
        //     extract($data);
        // }

/////
    // $tblquery66 = "SELECT * FROM tbl_users WHERE usr_email = :email && usr_paymentStatus = 'Paid'";
    //     $tblvalue66 = array(
    //         ':email' => $_SESSION['email']
    //     );
    //     $select66 =$connect->tbl_select($tblquery66, $tblvalue66);
    //     if($select66){
    //        // echo "
    //         //<script> window.location='dashboard' </script>
    //         //";
    //     }
    //     else
    //     {
    //           echo "
    //         <script> window.location='login' </script>
    //         ";
    //     }
        
   
   /////
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 ml-4 mb-0 text-gray-800">Dashboard</h1>
        <button class="btn btn-success btn-md">Welcome <?php echo $_SESSION['u_name']; ?></button>
    </div>
</div>

<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
        <div class="col-md-10">
            <h3>This is the User Dashboard</h3>
            <div style="overflow-x:auto">
                
            </div>	
   	    </div>
   	    <div class="col"></div>
    </div>
</div>
