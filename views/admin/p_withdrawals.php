<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>All Withdrawals</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Names</th>
                                <th>Counts</th>
                                <th>Amount</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT withdrawal.user_id, COUNT(withdrawal.amt) AS w_count, SUM(withdrawal.amt) AS w, tbl_users.l_name, tbl_users.f_name, tbl_users.profile FROM withdrawal INNER JOIN tbl_users ON withdrawal.user_id = tbl_users.usr_ID WHERE withdrawal.status = :status GROUP BY withdrawal.user_id ORDER BY tbl_users.l_name DESC";
                                $tblvalue = array(
                                    ':status' => 'Pending'
                                );
                                $select =$connect->tbl_select($tblquery, $tblvalue);
                                $si = 1;
                                if($select){
                                    foreach($select as $data){
                                        extract($data);
                                        $_SESSION['user_fullname'] = $l_name . ' ' . $f_name;
                                        ?>
                                        <?php
                                            echo "
                                                <tr>
                                                    <td>$si</td>
                                                    <td>
                                                        <img src='uploads/$profile' class='img-profile rounded-circle' style='width: 40px'>
                                                    </td>
                                                    <td>$l_name $f_name</td>
                                                    <td>$w_count</td>
                                                    <td>$w</td>
                                                    <td>
                                                        <form action='$url[0]/p_withdrawals' method='POST'>
                                                            <input type='hidden' name='id' value='$user_id'>
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
                                            <td colspan='8'>No pending withdrawal</td>
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

        $_SESSION['with_id'] = $id;
        echo "<script>  window.location='$url[0]/all_p_withdrawals' </script>";
    }

?>