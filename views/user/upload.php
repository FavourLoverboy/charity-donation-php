<?php 
// if($_SESSION['accessType'] == "Admin"){
//     echo "<script>window.location='dashboard'</script>";

// }
//         $tblquery4 = "SELECT * FROM tbl_uploads WHERE upd_user = :email";
//         $tblvalue4 = array(
//             ':email' => $_SESSION['email']
//         );
//         $select4 =$connect->tbl_select($tblquery4, $tblvalue4);
//         if($select4){
//             echo "
//             <script> window.location='dashboard' </script>
//             ";
//         }
//         foreach($select4 as $data4){
//             extract($data4);
//         }
        
//    /////
//     $tblquery66 = "SELECT * FROM tbl_users WHERE usr_email = :email && usr_paymentStatus = 'Paid'";
//         $tblvalue66 = array(
//             ':email' => $_SESSION['email']
//         );
//         $select66 =$connect->tbl_select($tblquery66, $tblvalue66);
//         if($select66){
//            // echo "
//             //<script> window.location='dashboard' </script>
//             //";
//         }
//         else
//         {
//               echo "
//             <script> window.location='dashboard' </script>
//             ";
//         }
        
   
   /////
        
        
        
        

//         if($_POST){
//         $target_dir = "uploads/";
//         $filename = htmlspecialchars( basename( $_FILES["file"]["name"]));
//         $target_file = $target_dir . basename($_FILES["file"]["name"]);
//         $uploadOk = 1;
// 	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//         extract($_POST);
//         $tblquery = "INSERT INTO tbl_uploads VALUES(:upd_ID, :upd_user, :upd_filename, :upd_fullname, :upd_stagename, :upd_phone, :upd_email, :upd_instagram, :upd_dateCreated)";
//         $tblvalue = array(
//             ':upd_ID' => NULL,
//             ':upd_user' => $_SESSION['email'],
//             ':upd_filename' => $filename,
//             ':upd_fullname' => htmlspecialchars($fullname),
//             ':upd_stagename' => htmlspecialchars($stagename),
//             ':upd_phone' => htmlspecialchars($phoneNumber),
//             ':upd_email' => htmlspecialchars($email),
//             ':upd_instagram' => htmlspecialchars($instagram),
//             ':upd_dateCreated' => date("y-m-d h:i")
//         );
//         $insert =$connect->tbl_insert($tblquery, $tblvalue);
//         if($insert){
//             move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
//             echo "
//                 <script>
//                 swal('File Uploaded', 'File successfully uploaded', 'success');
//                 </script>
//             ";
//             echo "<script>window.location='https://broadwayentertainment.org'</script>";
// }

//         }
?>

<div class="container">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 ml-4 mb-0 text-gray-800">Upload Video</h1>
                    </div>
</div>

<div class="container">
<form method="POST" action="upload" class="user" enctype="multipart/form-data">
<div class="row">
                    <div class="col-lg"></div>
                    <div class="col-lg-7">
                    <div class="card o-hidden border-0 shadow-lg mb-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-3">
                        <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Upload your 1 minute video below</h1>
                            </div>
                            <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Enter Full Name" name="fullname" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Enter Stage-Name" name="stagename" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="form-control form-control-user"
                                                placeholder="Enter Phone-Number" name="phoneNumber" required>
                                        </div>
                            <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Enter Instagram Handle" name="instagram">
                                        </div>
                              <div class="form-group row">
                                <input type="file" name="file">
                                </div>
                                <p>upload is only done once! so be careful!</p>
                                <button type="submit" name="submit" class="btn btn-success btn-user btn-block" style="font-size:1.2rem; color:#ffffff">
                                    Upload now <i class="fa fa-arrow-right"></i></button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
                    </div>
                    <div class="col-lg"></div>
        </div>  

    </form>  
    </div>

   