<?php 
    // Balance
    $tblquery = "SELECT COUNT(amt) AS b_amt, SUM(amt) AS amt FROM bonus WHERE rec_id = :id";
    $tblvalue = array(
        ':id' => $_SESSION['myId']
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['bonus'] = (int) $amt;
        $_SESSION['bonus_count'] = (int) $b_amt;
    }

    $tblquery = "SELECT SUM(amt) AS amt2 FROM withdrawal WHERE user_id = :id AND status = :status";
    $tblvalue = array(
        ':id' => $_SESSION['myId'],
        ':status' => 'Approve'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['w'] = (int) $amt2;
        $_SESSION['balance'] = $_SESSION['bonus'] - $_SESSION['w'];
    }

    // Withdrawals
    $tblquery = "SELECT COUNT(amt) AS w_count, SUM(amt) AS w FROM withdrawal WHERE user_id = :id AND status = :status";
    $tblvalue = array(
        ':id' => $_SESSION['myId'],
        ':status' => 'Approve'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['withdraw'] = (int) $w;
            $_SESSION['withdraw_count'] = (int) $w_count;
        }
    }else{
        $_SESSION['withdraw'] = (int) 0.00;
        $_SESSION['withdraw_count'] = (int) 0.00;
    }

    // Pending Withdrawals
    $tblquery = "SELECT COUNT(amt) AS pw_count, SUM(amt) AS pw FROM withdrawal WHERE user_id = :id AND status = :status";
    $tblvalue = array(
        ':id' => $_SESSION['myId'],
        ':status' => 'Pending'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['p_withdraw'] = (int) $pw;
            $_SESSION['p_withdraw_count'] = (int) $pw_count;
        }
    }else{
        $_SESSION['p_withdraw'] = (int) 0.00;
        $_SESSION['p_withdraw_count'] = (int) 0.00;
    }

    // Donation
    $tblquery = "SELECT COUNT(amt) AS count_d, SUM(amt) AS d FROM payments WHERE user_id = :id";
    $tblvalue = array(
        ':id' => $_SESSION['myId']
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['donation'] = (int) $d;
            $_SESSION['donation_count'] = (int) $count_d;
        }
    }else{
        $_SESSION['donation'] = (int) 0.00;
        $_SESSION['donation_count'] = (int) 0;
    }

    // Referrals
    $tblquery = "SELECT COUNT(usr_ID) AS ids FROM tbl_users WHERE ref = :my_ref";
    $tblvalue = array(
        ':my_ref' => $_SESSION['my_ref']
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['refferals'] = (int) $ids;
        }
    }else{
        $_SESSION['refferals'] = (int) 0;
    }
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 ml-4 mb-0 text-gray-800">Dashboard</h1>
        <button class="btn btn-success btn-md">Welcome <?php echo $_SESSION['u_name']; ?></button>
    </div>
</div>

<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row fav-dash">
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fas fa-university"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo 'N', number_format($_SESSION['balance']); ?></div>
                            <div class="col-md-12 text-center bottom">Balance</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['donation_count'], '/', number_format($_SESSION['donation']); ?></div>
                            <div class="col-md-12 text-center bottom">Donations</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fa fa-gift" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['bonus_count'], '/', number_format($_SESSION['bonus']); ?></div>
                            <div class="col-md-12 text-center bottom">Earn</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span><i class="fa fa-globe" aria-hidden="true"></i></span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['withdraw_count'], '/', number_format($_SESSION['withdraw']); ?></div>
                            <div class="col-md-12 text-center bottom">Withdrawals</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fa fa-pause" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['p_withdraw_count'], '/', number_format($_SESSION['p_withdraw']); ?></div>
                            <div class="col-md-12 text-center bottom">P. Withdrawals</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
        <div class="col-md-3 p-1">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['refferals']; ?></div>
                            <div class="col-md-12 text-center bottom">Referrals</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
    </div>
</div>
