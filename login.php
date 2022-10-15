<?php include('includes/header.php');?>
<?php include('includes/more/header.php');?>

<?php 

    $ip = $_REQUEST['REMOTE_ADDR']; // the IP address to query
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success') {
        $_SESSION['country'] = $query['country'];
    }

    if($_SESSION['country'] == 'Nigeria'){
        $_SESSION['amount'] = 200000;
        // $_SESSION['currency'] = 'NGN';
    }
    elseif($_SESSION['country'] == 'Ghana'){
        $_SESSION['amount'] = 4011.06;
        // $_SESSION['currency'] = 'GHS';
    }
    elseif($_SESSION['country'] == 'Cameroon'){
        $_SESSION['amount'] = 1290.12;
        // $_SESSION['currency'] = 'USD';
    }else{
        $_SESSION['amount'] = 4352.00;
        // $_SESSION['currency'] = 'USD';
    }

?>

    <div class="container-fluid bg-image">
    <div class="bg-image-overlay">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 mb-4">
                <div class="card o-hidden border-0 shadow-lg mt-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        <form class="user" method="POST" id="paymentForm" action="login.php">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Your Email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" style="font-size:1rem; color:#ffffff;" class="btn btn-success btn-user btn-block btn-color-black">
                                                LOGIN <i class="fas fa-key"></i>
                                            </button>
                                        </form>
                                        <div class="text-center my-2" style="color: red;">
                                            <?php echo $msg ?? "";?>
                                        </div>
                                        <div class="text-center">
                                            <a class="h6 my-2" href="register.php">Already Registered? Sign Up Here!</a>
                                        </div>
                                        
                                        <script>
                                            function show1(){
                                                var x = document.getElementById("pass1");
                                                var y = document.getElementById("pass2");
                                                if (x.type && y.type === "password"){
                                                    x.type = "text";
                                                    y.type = "text";
                                                }else{
                                                    x.type = "password";
                                                    y.type = "password";
                                                }
                                            }
                                            var password = document.getElementById("pass1");
                                            var confirm_password = document.getElementById("pass2");

                                            function validatePassword(){
                                                if(password.value != confirm_password.value){
                                                    confirm_password.setCustomValidity("Passwords Don't Match");
                                                }else{
                                                    confirm_password.setCustomValidity('');
                                                }
                                            }
                                            password.onchange = validatePassword;
                                            confirm_password.onkeyup = validatePassword;
                                        </script>
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
        $encryptPassword = $connect->epass($password);
        $tblquery = "SELECT * FROM tbl_users WHERE (email = :login || u_name = :login) && password = :password";
        $tblvalue = array(
            ':login' => htmlspecialchars($email),
            ':password' => htmlspecialchars($encryptPassword)
        );
        print_r($tblvalue);
        $login = $connect->tbl_select($tblquery, $tblvalue);
        
        if($login){
            foreach($login as $data){
                extract($data);
                $_SESSION['myId'] = $usr_ID;
                $_SESSION['email'] = $email;
                $_SESSION['u_name'] = $u_name;
                $_SESSION['role'] = $role;
                $_SESSION['ref'] = $ref;
                $_SESSION['profile'] = $profile;

                if($_SESSION['role'] == '1'){
                    echo "<script>  window.location='admin/dashboard' </script>";
                }else{
                    echo "<script>  window.location='user/dashboard' </script>";
                }
            }
        }else{
            echo "
                <script>
                    swal({
                        title: 'Login Unsuccessful', 
                        text: 'Login details wrong', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }

    }
?>