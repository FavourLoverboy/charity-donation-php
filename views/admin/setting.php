<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <form class="form-setting" action='<?php echo $url[0], '/setting'; ?>' method="POST">
            <h3>Change Password</h3>
            <div class="form-group">
                <label for="old" class="m-0">Old Password</label>
                <input type="password" name="old" class="form-control form-control-user"  id="old" placeholder="Enter Old Password" required>
            </div>
            <div class="form-group">
                <label for="new" class="m-0">New Password</label>
                <input type="password" name="new" class="form-control form-control-user" id="new" placeholder="Enter New Password" required>
            </div>
            <div class="form-group">
                <label for="com" class="m-0">Comfirm Password</label>
                <input type="password" name="com" class="form-control form-control-user" id="com" placeholder="Comfirm Password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="password" class="btn btn-primary" value="Change password">
            </div>
        </form>
    </div>

    <div class="row">
        <form class="form-setting" action='<?php echo $url[0], '/setting'; ?>' method="POST" enctype="multipart/form-data">
            <h3>Profile Picture</h3>
            <div class="form-group">
                <label for="img" class="m-0">Image</label>
                <input type="file" name="file" class="form-control form-control-user"  id="img" required>
            </div>
            <div class="form-group">
                <input type="submit" name="profile" class="btn btn-primary" value="Update Profile">
            </div>
        </form>
    </div>

    <!-- User Details -->
    <div class="row">
        <form class="form-setting" action='<?php echo $url[0], '/setting'; ?>' method="POST">
            <h3>My Details</h3>
            <?php 
            
                $tblquery = "SELECT * FROM tbl_users WHERE usr_ID = :id";
                $tblvalue = array(
                    ':id' => $_SESSION['myId']
                );
                $select = $connect->tbl_select($tblquery, $tblvalue);
                if($select){
                    foreach($select as $data){
                        extract($data);
                        echo "
                            <div class='form-group'>
                                <label for='l_name' class='m-0'>Last Name</label>
                                <input type='text' name='l_name' class='form-control form-control-user'  id='l_name' placeholder='Enter Last Name' value='$l_name' required>
                            </div>
                            <div class='form-group'>
                                <label for='f_name' class='m-0'>First Name</label>
                                <input type='text' name='f_name' class='form-control form-control-user' id='f_name' placeholder='Enter First Name' value='$f_name' required>
                            </div>
                            <div class='form-group'>
                                <label for='u_name' class='m-0'>Username</label>
                                <input type='text' name='u_name' class='form-control form-control-user' id='u_name' placeholder='Enter Username' value='$u_name' required>
                            </div>
                            <div class='form-group'>
                                <label for='email' class='m-0'>Email</label>
                                <input type='email' name='email' class='form-control form-control-user' id='email' placeholder='Enter Email' value='$email' required>
                            </div>
                            <div class='form-group'>
                                <label for='number' class='m-0'>Number</label>
                                <input type='text' name='phone' class='form-control form-control-user' id='number' placeholder='Enter Number' value='$phone' required>
                            </div>
                            <div class='form-group'>
                                <label class='m-0'>My Ref Code</label>
                                <input type='text' class='form-control form-control-user' value='$my_ref' readonly>
                            </div>
                            <div class='form-group'>
                                <label class='m-0'>My Ref Code</label>
                                <input type='text' class='form-control form-control-user' value='$date' readonly>
                            </div>
                            <div class='form-group'>
                                <input type='submit' name='details' class='btn btn-primary' value='Update Info'>
                            </div>
                        ";
                    }
                }

            ?>
        </form>
    </div>
</div>

<?php 

    if($_POST['profile']){
        extract($_POST);

        //Get the Name of the Uploaded File
        $fileName = $_FILES['file']['name'];

        // Choose where to save the Upload File
        $location = "uploads/".$fileName;

        // Save the uploaded File to the local file system
        if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        
        }

        $tblquery = "UPDATE tbl_users SET profile = :profile WHERE usr_ID = :id";
        $tblvalue = array(
            ':profile' => htmlspecialchars($fileName),
            ':id' => $_SESSION['myId']
        );
        $update = $connect->tbl_update($tblquery, $tblvalue);
        if($update){
            echo "
                <script>
                    swal({
                        title: 'Profile', 
                        text: 'your profile image has been updated',
                        icon: 'success',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }
    }
    if($_POST['details']){
        extract($_POST);

        $tblquery = "UPDATE tbl_users SET f_name = :f_name, l_name = :l_name, phone = :phone, u_name = :u_name, email = :email WHERE usr_ID = :id";
        $tblvalue = array(
            ':f_name' => htmlspecialchars($f_name),
            ':l_name' => htmlspecialchars($l_name),
            ':phone' => htmlspecialchars($phone),
            ':u_name' => htmlspecialchars($u_name),
            ':email' => htmlspecialchars($email),
            ':id' => $_SESSION['myId']
        );
        $update = $connect->tbl_update($tblquery, $tblvalue);
        if($update){
            echo "
                <script>
                    swal({
                        title: 'Updated', 
                        text: 'your details has been updated', 
                        icon: 'success',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }
    }
    if($_POST['password']){
        extract($_POST);

        $encryptPassword = $connect->epass($old);
        if($encryptPassword != $_SESSION['password']){
            echo "
                <script>
                    swal({
                        title: 'Password Error', 
                        text: 'your password is not correct', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif($new != $com){
            echo "
                <script>
                    swal({
                        title: 'Password Error', 
                        text: 'password do not match', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }else{
            $encryptPassword = $connect->epass($new);
            $tblquery = "UPDATE tbl_users SET password = :password WHERE usr_ID = :id";
            $tblvalue = array(
                ':password' => htmlspecialchars($encryptPassword),
                ':id' => $_SESSION['myId']
            );
            $update = $connect->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "
                    <script>
                        swal('Password Successful', 'Your password has been change click on the button below to continue.').then(function(){
                            window.location.href='logout.php'
                        });
                    </script>
                "; 
            }
        }
    }

?>