<?php 

    $tblquery = "SELECT ref FROM tbl_users WHERE usr_ID = :id";
    $tblvalue = array(
        ':id' => 10
    );
    $select = $connect->tbl_select($tblquery, $tblvalue);
    foreach($select as $data) {
        extract($data);
        if($ref){
            echo 'found something';
        }else{
            echo 'there is no data found';
        }
    }
    
    
    // Initialize cURL.
    // $ch = curl_init();

    // Set the URL that you want to GET by using the CURLOPT_URL option.
    // curl_setopt($ch, CURLOPT_URL, 'https://exchange-rates.abstractapi.com/v1/live/?api_key=2b963e8cbb3e472c9feb2692338ab603&base=USD&target=USD');

    // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Execute the request.
    // $data = curl_exec($ch);

    // Close the cURL handle.
    // curl_close($ch);

    // Print the data out onto the page.
    // echo $data;
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a onclick="popupDepositWrapper()">
            <button class="btn btn-success btn-md">Make Payment</button>
        </a>
    </div>
</div>
<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>My Payments</h3>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM payments WHERE user_id = :id ORDER BY date DESC";
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
                    <h4>Make new deposit</h4>
                </div>
                <div class="col-xs-1 close" onclick="popupDepositWrapper()">
                    <h4><span><i class='fa fa-times' aria-hidden='true'></i></span></h4>
                </div>
            </div>
        </div>
        <div class="bottom">
            <form action="<?php echo $url[0],'/payments' ?>" method="POST">
                <input type="text" name="amt" value="<?php echo $_SESSION['amount']; ?>" required style="color: #000;" readonly>
                <input type="submit" name="payment" class="btn" value="Proceed">
            </form>
        </div>
    </div>
</div>

<?php 

    if($_POST['payment']){
        extract($_POST);

        $_SESSION['amt'] = $amt;
        echo "<script>  window.location='$url[0]/payment' </script>";
    }

?>