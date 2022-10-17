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
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM withdrawal WHERE user_id = :id ORDER BY date DESC";
                                $tblvalue = array(
                                    ':id' => $_SESSION['with_id']
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
                                                    <td>$si</td>
                                                    <td>$amt</td>
                                                    <td>$date</td>
                                                    <td>$status</td>
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

<?php 

    if($_POST){
        extract($_POST);

        $_SESSION['with_id'] = $id;
        echo "<script>  window.location='$url[0]/all_withdrawals' </script>";
    }

?>