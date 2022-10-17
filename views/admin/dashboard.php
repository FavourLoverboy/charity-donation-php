<?php 
    // Members
    $tblquery = "SELECT COUNT(usr_ID) AS id FROM tbl_users WHERE role = :role";
    $tblvalue = array(
        ':role' => 0
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['members'] = $id;
    }

    // Payments
    $tblquery = "SELECT COUNT(id) AS payment_id, COUNT(DISTINCT(user_id)) AS user_ids, SUM(amt) AS s_amt FROM payments";
    $tblvalue = array();
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['all_payments'] = $payment_id;
        $_SESSION['all_payments_users'] = $user_ids;
        $_SESSION['all_payments_amt'] = $s_amt;
    }

    // Bonus
    $tblquery = "SELECT COUNT(id) AS bonus_id, COUNT(DISTINCT(rec_id)) AS rec_id, SUM(amt) AS s_amt FROM bonus";
    $tblvalue = array();
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['all_bonus'] = $bonus_id;
        $_SESSION['rec_bonus'] = $rec_id;
        $_SESSION['rec_bonus_amt'] = $s_amt;
    }

    // Withdrawals
    $tblquery = "SELECT COUNT(user_id) AS all_id, COUNT(DISTINCT(user_id)) AS d_id, SUM(amt) AS s_amt FROM withdrawal WHERE status = :status";
    $tblvalue = array(
        ':status' => 'Approve'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['w_all_id'] = $all_id;
        $_SESSION['w_d_id'] = $d_id;
        $_SESSION['w_s_amt'] = $s_amt;
    }

    // P.Withdrawals
    $tblquery = "SELECT COUNT(user_id) AS all_id, COUNT(DISTINCT(user_id)) AS d_id, SUM(amt) AS s_amt FROM withdrawal WHERE status = :status";
    $tblvalue = array(
        ':status' => 'Pending'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['pw_all_id'] = $all_id;
        $_SESSION['pw_d_id'] = $d_id;
        $_SESSION['pw_s_amt'] = $s_amt;
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
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="row top-bottom-bend">
                    <div class="col-4 icon">
                        <span>
                            <i class="fas fa-address-book"></i>
                        </span>
                    </div>
                    <div class="col-8 inner-right">
                        <div class="row">
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['members']; ?></div>
                            <div class="col-md-12 text-center bottom">Members</div>
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
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['all_payments_users'], '/', $_SESSION['all_payments'], '/', number_format($_SESSION['all_payments_amt']); ?></div>
                            <div class="col-md-12 text-center bottom">Payments</div>
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
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['rec_bonus'], '/', $_SESSION['all_bonus'], '/', number_format($_SESSION['rec_bonus_amt']); ?></div>
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
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['w_d_id'], '/', $_SESSION['w_all_id'], '/', number_format($_SESSION['w_s_amt']); ?></div>
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
                            <div class="col-md-12 text-center top"><?php echo $_SESSION['pw_d_id'], '/', $_SESSION['pw_all_id'], '/', number_format($_SESSION['pw_s_amt']); ?></div>
                            <div class="col-md-12 text-center bottom">P. Withdrawals</div>
                        </div>
                    </div>
                </div>
            </div>
   	    </div>
    </div>
</div>
