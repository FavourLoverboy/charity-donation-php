<?php 
    // Balance
    $tblquery = "SELECT SUM(amt) AS amt FROM bonus WHERE rec_id = :id";
    $tblvalue = array(
        ':id' => $_SESSION['myId']
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data){
        extract($data);
        $_SESSION['bonus'] = (int) $amt;
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
    $tblquery = "SELECT SUM(amt) AS w FROM withdrawal WHERE user_id = :id AND status = :status";
    $tblvalue = array(
        ':id' => $_SESSION['myId'],
        ':status' => 'Approve'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['withdraw'] = (int) $w;
        }
    }else{
        $_SESSION['withdraw'] = (int) 0.00;
    }

    // Pending Withdrawals
    $tblquery = "SELECT SUM(amt) AS pw FROM withdrawal WHERE user_id = :id AND status = :status";
    $tblvalue = array(
        ':id' => $_SESSION['myId'],
        ':status' => 'Pending'
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    if($select){
        foreach($select as $data){
            extract($data);
            $_SESSION['p_withdraw'] = (int) $pw;
        }
    }else{
        $_SESSION['p_withdraw'] = (int) 0.00;
    }
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a onclick="popupDepositWrapper()">
            <button class="btn btn-success btn-md">Make Withdrawal</button>
        </a>
    </div>
</div>
<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>My Withdrawals</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM withdrawal WHERE user_id = :id ORDER BY date DESC";
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
                                                    <th>$amt</th>
                                                    <th>$status</th>
                                                    <th>$date</th>
                                                </tr>
                                            ";
                                            $si++;
                                    }
                                }else{
                                    echo "
                                        <tr>
                                            <td colspan='8'>No Payment made yet</td>
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

<div class="container-fluid popup-deposit-wrapper">
    <div class="main-box">
        <div class="head">
            <div class="row">
                <div class="col-xs-11">
                    <h4>New Withdrawal</h4>
                </div>
                <div class="col-xs-1 close" onclick="popupDepositWrapper()">
                    <h4><span><i class='fa fa-times' aria-hidden='true'></i></span></h4>
                </div>
            </div>
        </div>
        <div class="bottom">
            <form action="<?php echo $url[0],'/withdraws' ?>" method="POST">
                <input type="text" name="amt" placeholder="Enter amount" required style="color: #000;">
                <input type="submit" name="withdraw" class="btn" value="Proceed">
            </form>
        </div>
    </div>
</div>

<?php 

    if($_POST['withdraw']){
        extract($_POST);

        if($amt < 500){
            echo "
                <script>
                    swal({
                        title: 'Error', 
                        text: 'Your withdrawal must be more than N500', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }else if($amt > $_SESSION['balance']){
            echo "
                <script>
                    swal({
                        title: 'Insufficient Funds', 
                        text: 'Your account balance is lower than your withdraw request', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }elseif($amt + $_SESSION['p_withdraw'] > $_SESSION['balance']){
            echo "
                <script>
                    swal({
                        title: 'Insufficient Funds', 
                        text: 'You still have pending withdraw(s), reduce your withdrawal amount if neccesary.', 
                        icon: 'error',
                        confirmButtonColor: '#c60000'
                    });
                </script>
            ";
        }else{
            $tblquery = "INSERT INTO withdrawal VALUES(:id, :user_id, :amt, :date, :status)";
            $tblvalue = array(
                ':id' => NULL,
                ':user_id' => $_SESSION['myId'],
                ':amt' => htmlspecialchars($amt),
                ':date' => date("Y-m-d h:i"),
                ':status' => 'Pending'
            );
            $insert =$connect->tbl_insert($tblquery, $tblvalue);

            if($insert){
                echo "
                    <script>
                        swal('Withdraw Successful', 'Your withdrawal has been sent').then(function(){
                            window.location.href='$url[0]/withdraws'
                        });
                    </script>
                ";
            }
        }
    }

?>