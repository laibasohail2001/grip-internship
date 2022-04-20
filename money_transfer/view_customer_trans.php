<?php
include('db_connect.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    
    
   
<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('header.php')
    ?>
     <h6 class="heading" style="font-family: fantasy; font-size:xx-large; margin-left: 20px;">Costumer's Details</h6>
    
    <table style="margin-left: 10%; margin-top: 50px;">
        <tr>
            <th style="border: 1px solid;" >Name</th>
             <th style="border: 1px solid black;">Email</th>
            <th style="border: 1px solid black;">Account ID</th>
            <th style="border: 1px solid black;" >Balance</th>
            <th style="border: 1px solid black;">Contact</th>
            <th style="border: 1px solid black;">Address</th>
            
            <th style="border: 1px solid black;">Country</th> 
           
        </tr>

    
<?php 

$sql = "SELECT * FROM viewcostumer";
$result = $conn->query($sql);


    while($row = $result->fetch_assoc())
    {
        ?>
       
        <tr>
       <td style='border: 1px solid black;'><?php echo $row['name'];?></td>
       <td style='border: 1px solid black;'><?php echo $row['email'];?></td>
       <td style='border: 1px solid black;'><?php echo $row['accID'];?></td>
       <td style='border: 1px solid black;'><?php echo $row['balance'];?></td>
       <td style='border: 1px solid black;'><?php echo $row['contact'];?></td>
       <td style='border: 1px solid black;'><?php echo $row['address'];?></td>
       
       <td style='border: 1px solid black;'><?php echo $row['country'];?></td>
  
        
        
        </tr>
     <?php
    }
    $conn->close();
    ?>
</table>
</div>

<?php
include('footer.php');
?>


</body>
</html>