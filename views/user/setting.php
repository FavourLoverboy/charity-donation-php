<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <form class="form-setting" action='<?php echo $url[0], '/setting'; ?>' method="POST">
            <div class="form-group">
                <label for="old">Old Password</label>
                <input type="password" name="old" class="form-control form-control-user"  id="old" placeholder="Enter Old Password" required>
            </div>
            <div class="form-group">
                <label for="new">New Password</label>
                <input type="password" name="new" class="form-control form-control-user" id="new" placeholder="Enter New Password" required>
            </div>
            <div class="form-group">
                <label for="com">Comfirm Password</label>
                <input type="password" name="com" class="form-control form-control-user" id="com" placeholder="Comfirm Password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="password" class="form-control form-control-user" value="Change">
            </div>
        </form>
    </div>
</div>

<?php 

    if($_POST){
        extract($_POST);

        $tblquery = "UPDATE withdrawal SET status = :status WHERE id = :id";
        $tblvalue = array(
            ':status' => 'Approve',
            ':id' => $id
        );
        $update = $connect->tbl_update($tblquery, $tblvalue);
        if($update){
            echo "<script>  window.location='$url[0]/all_p_withdrawals' </script>";
        }
    }

?>