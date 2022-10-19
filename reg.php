<?php include('includes/header.php');?>
<?php include('includes/more/header.php');?>

    <title>Registration | I Hope In Christ</title>
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
                                        <h1 class="h4 text-gray-900 mb-4">REGISTER WITH US</h1>
                                        <form class="user" method="POST" action="register.php">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    placeholder="Enter Last-Name" name="l_name" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    placeholder="Enter First-Name" name="f_name" required>
                                            </div>

                                            <!-- Country -->
                                            <div class="form-group">
                                                <select class="form-control form-control-select" id="country" name="country" required>
                                                    <option value=""> --choose Country-- </option>
                                                    <?php include('./includes/listOfCountries.php'); ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="tel" class="form-control form-control-user"
                                                    placeholder="Enter Phone-Number" name="number" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    placeholder="Enter Username" name="u_name" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="password" placeholder="Enter Password" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="cpassword" placeholder="Enter Confirm Password" required>
                                                <small id="message"></small>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="ref" value="<?php echo $_SESSION['ref_code']; ?>" readonly>
                                            </div>
                                            <input type="checkbox" class="mt-1" style="cursor:pointer;" id="show" required>  <label for="show">Terms and Conditions</label>
                                            <button type="submit" onclick="payWithPaystack()" style="font-size:1rem; color:#ffffff;" class="btn btn-user btn-block btn-success btn-color-black">Register</button>
                                        </form>
                                        <div class="text-center my-2" style="color: red;">
                                            <?php echo $msg ?? "";?>
                                        </div>
                                        <div class="text-center">
                                            <a class="h6 my-2" href="login.php">Already Registered? Login Here!</a>
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
<?php include ('includes/footer.php');?>

<?php 
    if($_POST){
        extract($_POST);
        // checking email
        $tblquery = "SELECT email FROM tbl_users WHERE email = :email";
        $tblvalue = array(
            ':email' => htmlspecialchars($email)
        );
        $checkEmail = $connect->tbl_select($tblquery, $tblvalue);

        // checking username
        $tblquery = "SELECT u_name FROM tbl_users WHERE u_name = :u_name";
        $tblvalue = array(
            ':u_name' => htmlspecialchars($u_name)
        );
        $checkU_name = $connect->tbl_select($tblquery, $tblvalue);

        // checking referral ID
        $tblquery = "SELECT my_ref FROM tbl_users WHERE my_ref = :my_ref";
        $tblvalue = array(
            ':my_ref' => htmlspecialchars($ref)
        );
        $my_ref = $connect->tbl_select($tblquery, $tblvalue);

        // counting total referrals
        $tblquery = "SELECT COUNT(*) AS totalCount FROM tbl_users WHERE ref = :ref";
        $tblvalue = array(
            ':ref' => htmlspecialchars($ref)
        );
        $totalRef = $connect->tbl_select($tblquery, $tblvalue);
        foreach ($totalRef as $count) {
            extract($count);
            $allCount = $totalCount;
        }

        if($checkEmail){
            echo "
                <script>
                    swal({
                        title: 'Email already Used', 
                        text: 'Sorry your email address is already in use on our site', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif($checkU_name){
            echo "
                <script>
                    swal({
                        title: 'Username already taken', 
                        text: 'Sorry your username is already taken',
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif($password != $cpassword){
            echo "
                <script>
                    swal({
                        title: 'Password', 
                        text: 'Your password do not match', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif(strlen($ref) > 1 AND strlen($ref) != 10){
            echo "
                <script>
                    swal({
                        title: 'Referral ID', 
                        text: 'refferal ID should be 10 characters long', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif(strlen($ref) > 1 AND !$my_ref){
            echo "
                <script>
                    swal({
                        title: 'Referral ID', 
                        text: 'refferal ID is not found in our database', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif(strlen($ref) > 1 AND $allCount >= 10){
            echo "
                <script>
                    swal({
                        title: 'Referral ID', 
                        text: 'refferal ID has reach it limit of referrals', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }else{
            $encryptPassword = $connect->epass($password);
            $tblquery = "INSERT INTO tbl_users VALUES(:usr_ID, :f_name, :l_name, :country, :phone, :u_name, :email, :password, :my_ref, :ref, :role, :profile, :date)";
            $tblvalue = array(
                ':usr_ID' => NULL,
                ':f_name' => htmlspecialchars($f_name),
                ':l_name' => htmlspecialchars($l_name),
                ':country' => htmlspecialchars($country),
                ':phone' => htmlspecialchars($number),
                ':u_name' => htmlspecialchars($u_name),
                ':email' => htmlspecialchars($email),
                ':password' => htmlspecialchars($encryptPassword),
                ':my_ref' => time(),
                ':ref' => htmlspecialchars($ref),
                ':role' => htmlspecialchars('0'),
                ':profile' => htmlspecialchars('profile.svg'),
                ':date' => date("Y-m-d h:i")
            );
            $signup = $connect->tbl_insert($tblquery, $tblvalue);
            if($signup){
                echo "
                    <script>
                        swal('SignUp Successful', 'Your account has successfully been created click on the button below to continue.').then(function(){
                            window.location.href='login.php'
                        });
                    </script>
                "; 
            }
        }
    }
?>