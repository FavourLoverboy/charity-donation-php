<?php include('includes/header.php');?>
<?php include('includes/more/header.php');?>
    <title>Reset Password | I Hope In Christ</title>
    <div class="container-fluid bg-image">
    <div class="bg-image-overlay">
        <!-- Outer Row -->
        <div class="row justify-content-center login-page">
            <div class="col-md"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 mb-4">
                <div class="card o-hidden border-0 shadow-lg mt-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                        <form class="user" method="POST" id="paymentForm" action="reset.php">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Your Email" name="email" required>
                                            </div>
                                            <button type="submit" style="font-size:1rem; color:#ffffff;" class="btn btn-success btn-user btn-block btn-color-black">
                                            Reset <i class="fas fa-key"></i>
                                            </button>
                                        </form>
                                        <div class="text-center my-2" style="color: red;">
                                            <?php echo $msg ?? "";?>
                                        </div>
                                        <div class="text-center">
                                            <a class="h6 my-2" href="login.php">Login!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<?php include('includes/more/footer.php');?>
<?php include('includes/footer.php');?>

<?php 
    if($_POST){
        extract($_POST);
        
        $tblquery = "SELECT * FROM tbl_users WHERE email = :email";
        $tblvalue = array(
            ':email' => htmlspecialchars($email)
        );
        // print_r($tblvalue);
        $select = $connect->tbl_select($tblquery, $tblvalue);
        
        if($select){
            foreach($select as $data){
                extract($data);
                
                function random_strings($length_of_string){
                      
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                  
                    return substr(str_shuffle($str_result), 0, $length_of_string);
                }
                 
                $password =  random_strings(6);
                // $encryptPassword = $connect->epass($password);
                // $tblquery = "UPDATE tbl_users SET email = :e WHERE email = :email";
                // $tblvalue = array(
                //     ':e' => htmlspecialchars($email),
                //     ':email' => htmlspecialchars($email)
                // );
                // // print_r($tblvalue);
                // $select = $connect->tbl_select($tblquery, $tblvalue);
                // if($update){
                //     // email message
                // }
            }
        }else{
            echo "
                <script>
                    swal({
                        title: 'Missign Email', 
                        text: 'This email do not exist in our database', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }

    }
?>