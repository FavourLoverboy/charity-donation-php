<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>All Payments</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Names</th>
                                <th>Counts</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT COUNT(payments.amt) AS pm_count, SUM(payments.amt) AS pm, tbl_users.l_name, tbl_users.f_name, tbl_users.profile FROM payments INNER JOIN tbl_users ON payments.user_id = tbl_users.usr_ID GROUP BY payments.user_id ORDER BY payments.date DESC";
                                $tblvalue = array();
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
                                                    <td>$pm_count</td>
                                                    <td>$pm</td>
                                                </tr>
                                            ";
                                            $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No Payments made yet</td>
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