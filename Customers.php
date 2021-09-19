<!DOCTYPE html>
<html>
    <head>
        <title>Customer</title>
        <link rel="stylesheet" href="./css/index.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    </head>
<?php
    include "Config.php";
    $result=mysqli_query($conn,"select * from customer order by cid;");
    ?>
    <table  class="table caption-top table-hover text-center table-responsive">
        <caption class="text-center"><h2>List of Customers</h2></caption>
            <thead class="table-danger ">
                <tr >
                <th> Id </th>
                <th> Name </th>
                <th> Email </th>
                <th> Contact </th>
                <th> Balance </th>
                <th> View </th>
                </tr>
            </thead>
    <?php
    while($row=mysqli_fetch_assoc($result)){
    ?>    <tr>
            <td><?php echo $row['cid'] ?></td>
            <td><?php echo ucwords($row['first_name']).' '.ucwords($row['last_name']);?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['contact'];?></td>
            <td><?php echo $row['current_bal'];?></td>
            <td>
                <form action="SingleCustomer.php" method="POST"> 
                    <button class='btn btn-info block w-100' type="submit" name="cid" value="<?php echo $row['cid']?>"> view </button> 
                </form>
            </td>
            </tr>
<?php    }
?>          </tbody>
</table>
</html>
