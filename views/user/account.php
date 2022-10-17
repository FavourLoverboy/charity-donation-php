<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
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
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>My Accounts</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Bank</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM account WHERE user_id = :id ORDER BY time DESC";
                                $tblvalue = array(
                                    ':id' => $_SESSION['myId']
                                );
                                $select =$connect->tbl_select($tblquery, $tblvalue);
                                $si = 1;
                                if($select){
                                    foreach($select as $data){
                                        extract($data);
                                        ?>
                                        <?php
                                            echo "
                                                <tr>
                                                    <td>$si</td>
                                                    <td>$name</td>
                                                    <td>$numbers</td>
                                                    <td>$bank</td>
                                                    <td>
                                                        <form action='$url[0]/account' method='POST'>
                                                            <input type='hidden' name='id' value='$id'>
                                                            <input type='submit' name='delete' class='btn btn-danger btn-sm' value='delete'>
                                                        </form>
                                                    </td>
                                                </tr>
                                            ";
                                            $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No account yet</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>

                    </table>
                </div>	
            </div>
        <div class="col"></div>
    </div>
</div>

<?php 
    if($_POST['delete']){
        extract($_POST);
        $tblquery = "DELETE FROM account WHERE id = :id";
        $tblvalue = array(
            ':id' => $id
        );
        $delete = $connect->tbl_delete($tblquery, $tblvalue);
        if($delete){
            echo "
                <script>
                    swal('Account Deleted', 'The account has been deleted, click on the button below to continue.').then(function(){
                        window.location.href='$url[0]/account'
                    });
                </script>
            "; 
        }
    }
 
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
                    swal('Updated', 'your account have been added, click on the button below to continue.').then(function(){
                        window.location.href='$url[0]/account'
                    });
                </script>
            "; 
        }
    }
?>