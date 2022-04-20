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
    <style>
          body {
      background-image: url(images/bg1.jpg);
      background repeat: no-repeat;
      background-size: cover;
    }

    </style>
  
</head>
<body>
    <?php
    include('header.php');
    ?>
    <div class="row">
        <div class="col-12">
            <div class="container">
                <h2 style="text-align: center">TRANSACTION HISTORY</h2>
                <br>
                <table style="background-color:white; margin-left: 50px">
                    <tr>
                        <th style='border: 1px solid black;' >Payer's Name</th>
                        <th style='border: 1px solid black;'>Payer's Account No</th>
                        <th style='border: 1px solid black;'>Payee's Name</th>
                        <th style='border: 1px solid black;'>Payee's Account No</th>
                        <th style='border: 1px solid black;'>Amount</th>
                        <th style='border: 1px solid black;'>Time</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM history";
                    $result = $conn->query($sql);
                    
                    
                        while($row = $result->fetch_assoc())
                        {
                            ?>
                           
                            <tr>
                           <td style='border: 1px solid black;'><?php echo $row['payer'];?></td>
                           <td style='border: 1px solid black;'><?php echo $row['payerID'];?></td>
                           <td style='border: 1px solid black;'><?php echo $row['payee'];?></td>
                           <td style='border: 1px solid black;'><?php echo $row['payerID'];?></td>
                           <td style='border: 1px solid black;'><?php echo $row['amount'];?></td>
                           <td style='border: 1px solid black;'><?php echo $row['time'];?></td>
                           
                           
                      
                            
                            
                            </tr>
                         <?php
                        }
                        $conn->close();
                        ?>
                    
                </table>

            </div>

        </div>

    </div>
    <?php
    include('footer.php');
    ?>

    
</body>
</html>