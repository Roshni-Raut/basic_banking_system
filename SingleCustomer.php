<!DOCTYPE html>
<html>
    <head>
        <title> Customer Details </title>
        <style>
            *{
                background-color:beige;
            }
            </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        
    </head>
    <body>
<?php
    include 'Config.php';
    if(isset($_POST['sender']))
    {
        $id=$_POST['sender'];
        $rec=$_POST['receiver'];
        $amount=$_POST['amount'];
        
        $sender=mysqli_query($conn,'select * from customer where cid='.$id);
        $srow=mysqli_fetch_assoc($sender);

        if($srow['current_bal']<$amount){
            echo '<script> alert("Failed: Transaction failed due to insufficient balance. ")</script>';
        }else{
            $receiver=mysqli_query($conn,'select * from customer where cid='.$rec);
            $rrow=mysqli_fetch_assoc($receiver);

            $cur=$srow['current_bal']-$amount;
            mysqli_query($conn,'update customer SET current_bal='.$cur.' where cid='.$id);
            
            $cur=$amount+$rrow['current_bal'];
            mysqli_query($conn,'update customer SET current_bal='.$cur.' where cid='.$rec);
            
            $tran=mysqli_query($conn,'select * from transfer');
            $tid=mysqli_num_rows($tran)+1;
            
            mysqli_query($conn,'insert into transfer values('.$tid.','.$amount.','.$id.','.$rec.')');
            echo "<script> alert('Successfully tranfered Amount ".$amount." to ".ucwords($rrow['first_name']). "')</script>";
        }
    }else{    
        $id=$_POST['cid'];
    }
    $result=mysqli_query($conn,'select * from customer where cid='.$id);
    $row=mysqli_fetch_assoc($result);
    $transfers=mysqli_query($conn,'select * from transfer where sender='.$id);
    $n=mysqli_num_rows($transfers);
    $username=ucwords($row['first_name'].' '.$row['last_name']);
?>
    <div class="border-bottom border-dark p-3 text-center pb-3"> 
        <h2><u style="color:rgb(241, 134, 63)">Customer Detail</u></h2>
        <div class="container-fluid row text-muted mt-3">
            <div class="col">
                <b>Customer Id : <span class="text-dark"><?php echo $row['cid'] ?></span> </br>
                    Name: <span class="text-dark"><?php echo $username;?></span> </br>
                    Gender: <span class="text-dark"><?php echo $row['gender']?></span> </br></b>
            </div>
            <div class="col">
                <b>Email: <span class="text-dark"><?php echo $row['email'];?></span> </br>
                    Contact: <span class="text-dark"><?php echo $row['contact'];?></span> </br>
                    Current Balance: <span class="text-dark">&#8377;<?php echo $row['current_bal'];?></span> </br></b>
            </div>
        </div>
    </div>

    <form action="SingleCustomer.php" method="POST" class="border-bottom border-dark p-3">
        <fieldset class="p-3">
            <legend class="fw-bold" style="color:rgb(241, 134, 63)">New Transaction</legend>
            <div class="form-group m-2">
                <label for="from">From: </label>
                <input type="text" class="form-control m-1" value="<?php echo $username ?>" readonly>
            </div>
            <div class="form-group m-2">
                <label for="to">To:</label>
                <select class="form-control m-1" name="receiver" required>
                <option value="" disabled selected hidden> -- SELECT -- </option>
<?php
            $receivers=mysqli_query($conn,'select * from customer order by cid;');
            while($rrow=mysqli_fetch_assoc($receivers)){
                if($rrow['cid']!=$id){
?>
            <option value="<?php echo $rrow['cid'];?>"><?php echo ucwords($rrow['first_name'].' '.$rrow['last_name']);?></option>
<?php
                }
            }
?>
                </select>
            </div>
            <div class="form-group m-2">
                <label for="amount">Amount: </label>
                <input type="number" min="1" class="m-1 form-control" placeholder="Amount" name="amount" required>
            </div>
            <button type="submit" class="btn btn-success m-3" name="sender" value="<?php echo $id;?>">Transfer</button>
        </fieldset>
    </form>
<?php  
        if($n>0){
        ?>
            <table  class="table caption-top table-hover text-center table-responsive">
            <caption class="text-center"style="color:rgb(241, 134, 63)"><h2> Transactions History </h2></caption>
            <thead class="table-danger ">
                <tr>
                    <th> S. no. </th>
                    <th> Sender </th>
                    <th> Receiver </th>
                    <th> Amount </th>
                </tr>
            </thead>
<?php
    $i=1;
    while($row=mysqli_fetch_assoc($transfers)){
        $result2=mysqli_query($conn,"select * from customer where cid=".$row['receiver']);
        $row2=mysqli_fetch_assoc($result2);
?>      <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $username?></td>
            <td><?php echo ucwords($row2['first_name']).' '.ucwords($row2['last_name']);?></td>
            <td><?php echo $row['amount'];?></td>
        </tr>
<?php  }
?>      
        </table>
<?php
        }else{
            echo'<div class="h3 fw-bold text-center" style="color:rgb(241, 134, 63)"> no transactions yet!!! </div>';
        }
?>
    </body>
</html>