<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>My Earnings</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Depositor</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT bonus.amt, bonus.date, tbl_users.l_name, tbl_users.f_name  FROM bonus INNER JOIN tbl_users ON  bonus.payer_id = tbl_users.usr_ID WHERE bonus.rec_id = :id ORDER BY bonus.date DESC";
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
                                                    <th>$si</th>
                                                    <th>$l_name $f_name</th>
                                                    <th>$amt</th>
                                                    <th>$date</th>
                                                </tr>
                                            ";
                                            $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No Earning yet</td>
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
