
<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>Refferals</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7">Names: <?php echo $_SESSION['usrname']?></th>
                                <th colspan="8">There Refferals</th>
                            </tr>
                            <tr>
                                <th>S/N</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Reg Date</th>

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
                                        $_SESSION['em'] = $email;
                                        $display = 0;

                                        $tblquery = "SELECT profile AS pro, l_name As ln, f_name AS fn, email AS e, my_ref AS mr, phone AS p, country AS c, date AS d FROM tbl_users WHERE ref = :my_ref AND role = :role ORDER BY date DESC";
                                        $tblvalue = array(
                                            ':my_ref' => $my_ref,
                                            ':role' => 0
                                        );
                                        $select2 = $connect->tbl_select($tblquery, $tblvalue);
                                        $sii = 1;
                                        if($select2){
                                            foreach($select2 as $data2){
                                                extract($data2);
                                                $tblquery = "SELECT COUNT(usr_ID) AS all_ref FROM tbl_users WHERE ref = :my_ref AND role = :role";
                                                $tblvalue = array(
                                                    ':my_ref' => $mr,
                                                    ':role' => 0
                                                );
                                                $select3 = $connect->tbl_select($tblquery, $tblvalue);
                                                
                                                foreach($select3 as $data3){
                                                    extract($data3);
                                                    ?>
                                                    <?php
                                                    if($_SESSION['em'] == $email AND $display == 0){
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
    
                                                                    <td>$sii</td>
                                                                    <td>
                                                                        <img src='uploads/$pro' class='img-profile rounded-circle' style='width: 40px'>
                                                                    </td>
                                                                    <td>$ln $fn</td>
                                                                    <td>$e</d>
                                                                    <td>$p</td>
                                                                    <td>$c</td>
                                                                    <td>$d</td>
                                                                    <td>
                                                                        <form action='$url[0]/referrals' method='POST'>
                                                                            <input type='hidden' name='user_ref' value='$mr'>
                                                                            <input type='hidden' name='name' value='$ln $fn'>
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
    
                                                                    <td>$sii</td>
                                                                    <td>
                                                                        <img src='uploads/$pro' class='img-profile rounded-circle' style='width: 40px'>
                                                                    </td>
                                                                    <td>$ln $fn</td>
                                                                    <td>$e</d>
                                                                    <td>$p</td>
                                                                    <td>$c</td>
                                                                    <td>$d</td>
                                                                    <td>No Referral</td>
                                                                </tr>
                                                            ";
                                                        }
                                                    }else{
                                                        if($all_ref > 0){
                                                            echo "
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></d>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
    
                                                                    <td>$sii</td>
                                                                    <td>
                                                                        <img src='uploads/$pro' class='img-profile rounded-circle' style='width: 40px'>
                                                                    </td>
                                                                    <td>$ln $fn</td>
                                                                    <td>$e</d>
                                                                    <td>$p</td>
                                                                    <td>$c</td>
                                                                    <td>$d</td>
                                                                    <td>
                                                                        <form action='$url[0]/referrals' method='POST'>
                                                                            <input type='hidden' name='user_ref' value='$mr'>
                                                                            <input type='hidden' name='name' value='$ln $fn'>
                                                                            <input type='submit' name='see' class='btn btn-success btn-sm' value='see referrals $all_ref'>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            ";
                                                        }else{
                                                            echo "
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></d>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
    
                                                                    <td>$sii</td>
                                                                    <td>
                                                                        <img src='uploads/$pro' class='img-profile rounded-circle' style='width: 40px'>
                                                                    </td>
                                                                    <td>$ln $fn</td>
                                                                    <td>$e</d>
                                                                    <td>$p</td>
                                                                    <td>$c</td>
                                                                    <td>$d</td>
                                                                    <td>No Referral</td>
                                                                </tr>
                                                            ";
                                                        }
                                                    }
                                                    
                                                }
                                                $sii++;
                                                $display++;
                                            }
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

                                                    <td colspan='8'>No referral by the user</td>
                                                </tr>
                                            ";
                                        }
                                        $si++;
                                        $display = 0;
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
        
        $_SESSION['ur'] = $$user_ref;

        echo "<script>  window.location='$url[0]/tree' </script>";
    }

?>