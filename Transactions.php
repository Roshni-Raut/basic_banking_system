<!DOCTYPE html>
<html>
    <head>
        <title>Transaction</title>
        <style>
            *{
                background-color:beige;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
<?php
    include "Config.php";
    
    $result=mysqli_query($conn,"select * from transfer");
    $n=mysqli_num_rows($result);
    if($n>0){
    ?>
    <table  class="table caption-top table-hover text-center table-responsive">
        <caption class="text-center"><h2> All Transactions </h2></caption>
            <thead class="table-danger ">
                <tr>
                <th> T. Id </th>
                <th> Sender </th>
                <th> Receiver </th>
                <th> Amount </th>
                </tr>
            </thead>
    <?php
    while($row=mysqli_fetch_assoc($result)){
        $result1=mysqli_query($conn,"select * from customer where cid=".$row['sender']);
        $row1=mysqli_fetch_assoc($result1);
        $result2=mysqli_query($conn,"select * from customer where cid=".$row['receiver']);
        $row2=mysqli_fetch_assoc($result2);
    ?>    <tr>
            <td><?php echo $row['tid'] ?></td>
            <td><?php echo ucwords($row1['first_name'].' '.$row1['last_name']);?></td>
            <td><?php echo ucwords($row2['first_name'].' '.$row2['last_name']);?></td>
            <td><?php echo $row['amount'];?></td>
            </tr>
<?php    }
    }else{
        echo'<div class="h3 fw-bold text-center" style="color:rgb(241, 134, 63)"> no transactions yet!!! </div>';
    }
?>          </tbody>
</table>
</html>