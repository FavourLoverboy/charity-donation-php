<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>User Accounts</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Names</th>
                                <th>View Account</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM tbl_users WHERE role = :role ORDER BY l_name";
                                $tblvalue = array(
                                    ':role' => 0
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
                                                    <td>
                                                        <img src='uploads/$profile' class='img-profile rounded-circle' style='width: 40px'>
                                                    </td>
                                                    <td>$l_name $f_name</td>
                                                    <td>
                                                        <form action='$url[0]/accounts' method='POST'>
                                                            <input type='hidden' name='id' value='$usr_ID'>
                                                            <button type='submit' class='btn btn-success btn-sm'>View</>
                                                        </form>
                                                    </td>
                                                </tr>
                                            ";
                                            $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No User yet</td>
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

    if($_POST){
        extract($_POST);

        $_SESSION['account_id'] = $id;
        echo "<script>  window.location='$url[0]/user_account' </script>";
    }

?>