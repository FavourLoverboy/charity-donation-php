
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
                                <th colspan="7"><?php echo $_SESSION['usrname']; ?> Referrals</th>
                                <th>6th Level</th>
                            </tr>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Reg Date</th>
                                <th>View</th>
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
                                        $tblquery = "SELECT COUNT(usr_ID) AS all_ref, f_name AS fn, l_name AS ln FROM tbl_users WHERE ref = :ref AND role = :role";
                                        $tblvalue = array(
                                            ':ref' => $my_ref,
                                            ':role' => 0
                                        );
                                        $select2 = $connect->tbl_select($tblquery, $tblvalue);
                                        
                                        foreach($select2 as $data2){
                                            extract($data2);
                                            ?>
                                            <?php
                                            if($all_ref > 0){
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
                                                        <td>
                                                            <form action='$url[0]/tree5' method='POST'>
                                                                <input type='hidden' name='name' value='$l_name $f_name'>
                                                                <input type='hidden' name='user_ref' value='$my_ref'>
                                                                <input type='submit' name='see' class='btn btn-success btn-sm' value='see referrals $all_ref'>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                ";
                                            }else{
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
                                                        <td>
                                                            <button class='btn btn-sm btn-warning'>No referral</button>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                            
                                        }
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
<?php 

    if($_POST['see']){
        extract($_POST);

        $_SESSION['usrname'] = $name;
        
        $_SESSION['ur'] = $user_ref;

        echo "<script>  window.location='$url[0]/tree6' </script>";
    }

?>