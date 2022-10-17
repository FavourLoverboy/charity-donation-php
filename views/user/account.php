<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <?php 
                
            $tblquery = "SELECT * FROM account WHERE user_id = :id ORDER BY time DESC LIMIT 1";
            $tblvalue = array(
                ':id' => $_SESSION['myId']
            );
            $select = $connect->tbl_select($tblquery, $tblvalue);
            if($select){
                foreach($select as $data){
                    extract($data);
                    ?>
                    <?php
                    echo "
                        <p>Account Name: $name ||</p>
                        <p>Bank Name: $bank ||</p>
                        <p>Account Number: $numbers</p>
                    ";
                }
            }else{
                echo '<p>You have not added your account yet</p>';
            }
        ?>
    </div>
    <div class="row">
        <form class="form-setting" action='<?php echo $url[0], '/account'; ?>' method="POST">
            <h3>Account Details</h3>
            <div class="form-group">
                <label for="name" class="m-0">Name</label>
                <input type="text" name="name" class="form-control form-control-user"  id="name" placeholder="Enter Account Name" required>
            </div>
            <div class="form-group">
                <label for="number" class="m-0">Number</label>
                <input type="text" name="number" class="form-control form-control-user" id="number" placeholder="Enter Account Number" required>
            </div>
            <div class="form-group">
                <label for="bank" class="m-0">Bank</label>
                <input type="text" name="bank" class="form-control form-control-user" id="bank" placeholder="Enter Bank Name" required>
            </div>
            <div class="form-group">
                <input type="submit" name="account" class="btn btn-primary" value="Update Account Details">
            </div>
        </form>
    </div>
</div>

<?php 
    if($_POST['account']){
        extract($_POST);
        $tblquery = "INSERT INTO account VALUES(:id, :user_id, :name, :numbers, :bank, :time)";
        $tblvalue = array(
            ':id' => NULL,
            ':user_id' => htmlspecialchars($_SESSION['myId']),
            ':name' => htmlspecialchars($name),
            ':numbers' => htmlspecialchars($number),
            ':bank' => htmlspecialchars($bank),
            ':time' => time()
        );
        $insert = $connect->tbl_insert($tblquery, $tblvalue);
        if($insert){
            echo "
                <script>
                    swal('Account Successful', 'Your account details has been updated, click on the button below to continue.').then(function(){
                        window.location.href='$url[0]/account'
                    });
                </script>
            "; 
    }
    }

?>