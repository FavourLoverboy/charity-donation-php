<!-- /.container-fluid -->
<div class="container">
    <!-- Content Row -->
    <div class="row">
        <div class="col"></div>
            <div class="col-md-10">
                <h3>All Withdrawals</h3>
                <p><?php echo $_SESSION['user_fullname']; ?></p>
                <div style="overflow-x:auto">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tblquery = "SELECT * FROM withdrawal WHERE user_id = :id AND status = :status ORDER BY date DESC";
                                $tblvalue = array(
                                    ':id' => $_SESSION['with_id'],
                                    ':status' => 'Pending'
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
                                                    <td>$amt</td>
                                                    <td>$date</td>
                                                    <td>
                                                        <form action='$url[0]/all_p_withdrawals' method='POST'>
                                                            <input type='hidden' name='id' value='$id'>
                                                            <button type='submit' class='btn btn-success btn-sm'>Approve</>
                                                        </form>
                                                    </td>
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

        $tblquery = "UPDATE withdrawal SET status = :status WHERE id = :id";
        $tblvalue = array(
            ':status' => 'Approve',
            ':id' => $id
        );
        $update = $connect->tbl_update($tblquery, $tblvalue);
        if($update){
            echo "<script>  window.location='$url[0]/all_p_withdrawals' </script>";
        }
    }

?>