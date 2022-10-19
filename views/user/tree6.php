
<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th colspan="6"><?php echo $_SESSION['usrname']; ?> Referrals</th>
                                <th>7th Level</th>
                            </tr>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Reg Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM tbl_users WHERE ref = :ref AND role = :role";
                                $tblvalue = array(
                                    ':ref' => $_SESSION['ur'],
                                    ':role' => 0
                                );
                                $select = $connect->tbl_select($tblquery, $tblvalue);
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
                                                <td>$email</d>
                                                <td>$phone</td>
                                                <td>$country</td>
                                                <td>$date</td>
                                            </tr>
                                        ";
                                        $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No referral yet</td>
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