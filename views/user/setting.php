<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
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
?>