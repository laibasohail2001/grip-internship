<?php
include('db_connect.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Status Page</title>
    <link rel="stylesheet" href="style.css">
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
    <style>
          body {
      background-image: url(images/bg1.jpg);
      background repeat: no-repeat;
      background-size: cover;
    }
        .transferMoney{
        color:white;
        background-color: black ;
       
        padding: 20px;
        position:fixed;
        top: 60%;
        left:50%;
        transform: translate(-50%, -50%);

    }
    table, th, td {
  border: 1px solid white;
}
    </style>
</head>
<body>
    <?php
    include('header.php');
    
    ?>
    <?php
    if(isset($_POST['form_submitted'])){
       
       $PAYER_ID = $_POST['payerID']; 
       $PAYEE_ID = $_POST['payeeID']; 
       $AMOUNT = $_POST['amount']; 

     
       
       

       if(empty($PAYER_ID) || empty($PAYEE_ID) || empty($AMOUNT)){
           echo "<script> alert('fileds must not be empty!!');
           window.location.href='transfer.php';
           </script>";
           exit();
       }
       if($AMOUNT <=0){
        echo "<script> alert('Amount must be greater than zero !!');
        window.location.href='transfer.php';
        </script>";  
        exit() ;  
      }
       if(!ctype_digit($PAYER_ID) || !ctype_digit($PAYEE_ID) || !ctype_digit($AMOUNT)){
        echo "<script> alert('Entered value can only contain digit!!');
        window.location.href='transfer.php';
        </script>";  
        exit() ;  
      }
      $sqlcount = "SELECT COUNT(1) FROM viewcostumer WHERE accID='$PAYER_ID'";
      $r = $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1)
      {
          echo "<script> alert('Payers Account does not exist!!');
          window.location.href='transfer.php';
          </script>";
          exit();
      }
    
    $sqlcount = "SELECT COUNT(1) FROM viewcostumer WHERE accID='$PAYEE_ID'";
      $r = $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1)
      {
          echo "<script> alert('Payees Account does not exist!!');
          window.location.href='transfer.php';
          </script>";
          exit();
      }
          //CHECK IF PAYER HAS SUFFICIENT MONEY OR NOT
      $sql = "Select * from viewcostumer where accID='$PAYER_ID'";       
      if($result = $conn->query($sql)){            
           $row1 = $result->fetch_array(); 
           if($row1['balance']<$AMOUNT){
            echo "<script> alert('Payer does not have required balance !!');
            window.location.href='transfer.php';
            </script>";  
            exit() ; 
            }  
      } 
      echo "<div class ='center'>";
      echo "<div class ='center2'>";
      echo "<div class = 'transferMoney'>";
      echo "<h1 style='text-align: center'>Transaction Successfully Completed</h1>
            <p  style='text-align: center; font-size:25px;'>Details of payer and payee are as follows<p>
            <table>
            <tr>
            <th></th>
            <th style='border: 1px solid white;'>Account No</th>
            <th style='border: 1px solid white;'>Name</th>
            <th style='border: 1px solid white;'>Email</th>
           
            </tr>";

      //SELECTING PAYER DETAILS FROM ACCOUNTDETAILS TABLE
      $sql = "select * from viewcostumer where accID='$PAYER_ID'";       
      if($result=$conn->query($sql)){            
           $row1 = $result->fetch_array(); 
            //row1 contains payer details
                   echo "<tr> 
                        <td style='border: 1px solid white;'> Payer </td>
                        <td style='border: 1px solid white;'>".$row1['accID']."</td>
                        <td style='border: 1px solid white;'>".$row1['name']."</td>
                        <td style='border: 1px solid white;'>".$row1['email']."</td>
                       
                        </tr>";                        
                   $PayerCurrentBalance = $row1['balance'];            
        }
    
      //SELECTING PAYEE DETAILS FROM ACCOUNTDETAILS TABLE
      $sql2 = "select * from viewcostumer where accID ='$PAYEE_ID'";
      if($result = $conn->query($sql2)){
            //row2 contains payee details
            $row2 = $result->fetch_array();
                   echo "<tr> 
                        <td style='border: 1px solid white;'> Payee </td>
                        <td style='border: 1px solid white;'>".$row2['accID']."</td>
                        <td style='border: 1px solid white;'>".$row2['name']."</td>
                        <td style='border: 1px solid white;'>".$row2['email']."</td>
                       
                        </tr>"; 
                    $PayeeCurrentBalance = $row2['balance'];                       
           
           
        }               
        echo "</table>";
        $PayeeCurrentBalance += $AMOUNT;
        $PayerCurrentBalance -= $AMOUNT;
        echo "<br>";
        echo "<table>
                <tr>
                    <th></th>
                    <th style='border: 1px solid white;'>Old Balance</th>
                    <th style='border: 1px solid white;'>New Balance</th>
                </tr>
                <tr>
                    <th style='border: 1px solid white;'>Payer</th>
                    <td style='border: 1px solid white;'>".$row1['balance']."</td>                        
                    <td style='border: 1px solid white;'>".$PayerCurrentBalance."</td>
                </tr>
                <tr>
                    <th style='border: 1px solid white;'>Payee</th>
                    <td style='border: 1px solid white;'>".$row2['balance']."</td>                        
                    <td style='border: 1px solid white;'>".$PayeeCurrentBalance."</td>
                </tr>";
        echo "</table>";
        //echo "Payer has available Balance = ".$row1['balance']."<br>";           
        //echo "Payer has available Balance = ".$PayerCurrentBalance."<br>";
        //echo "Payee has available Balance = ".$PayeeCurrentBalance."<br>";

       //FOR UPDATING DETAILS OF PAYER
       $updatepayer ="Update viewcostumer set balance='$PayerCurrentBalance' where accID='$PAYER_ID'";
       //FOR UPDATING DETAILS OF PAYEE
       $updatepayee ="Update viewcostumer set balance='$PayeeCurrentBalance' where accID='$PAYEE_ID'";

       //CHECK IF PAYER DETAILS ARE UPADTED OR NOT 
       if($conn->query($updatepayer)==true){
            ?>         
            <script>console.log("PAYER DETAILS UPDATED!!")</script>
            <?php
       }
       else{
            ?>        
            <script>alert("PAYER DETAILS NOT UPDATED!!")</script>
            <?php
       }

       //CHECK IF PAYEE DETAILS ARE UPADTED OR NOT 
       if($conn->query($updatepayee)==true){
                ?>         
                <script>console.log("PAYEE DETAILS UPDATED! ")</script>
                <?php
        }
        else{
                ?>        
                <script>alert("PAYEE DETAILS NOT UPDATED! ERROR OCCURED!")</script>
                <?php
        }
        

        //SETTING TIME ZONE
        date_default_timezone_set('Asia/Kolkata');           
        $date = date('Y-m-d H:i:s',time());
        //echo "Current time is : ".$date;

        //FOR UPDATING HISTORY TABLE WHICH MAINTAINS RECORDS OF ALL TRANSACTIONS
        $InsertTransactTable ="Insert into history (payer, payerID, payee, payeeID, amount, time) values ('$row1[name]','$row1[accID]','$row2[name]','$row2[accID]','$AMOUNT','$date')";
        //EXECUTING INSERT COMMAND AND CHECKING IF INSERTION WAS SUCCESSULL OR NOT
        if($conn->query($InsertTransactTable)==true){
                ?>         
                <script>console.log("Record of this transaction saved! ")</script>
                <?php
        }
        else{
                ?>        
                <script>alert("Record of this transaction saved! ERROR OCCURED!")</script>
                <?php
        }


        echo "<br>";
    echo "</div>";
    echo "</div>";
   // echo"<script>alert('Transaction successfull!!')</script>";
    //END OF ELSE OF PROCEED BUTTON
 // }

//IF ENDS HERE    
}else{
  ?>
  <h1>All transactions are up to date</h1>
  <?php
}
//DATABASE CONNECTION ENDS HERE
$conn->close();
//PHP CODE ENDS HERE
?> 

   
</body>
</html>