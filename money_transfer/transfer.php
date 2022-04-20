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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
       body {
      background-image: url(images/bg1.jpg);
      background repeat: no-repeat;
      background-size: cover;
    }
      #form_transfer {
    text-align: center;
    background-color: lightgray;
    border: 1px solid black;
    width: 70%;
    height: auto;
    margin-left: 20%;
    margin-top: 50px;
    
}
#btn1 {
  border:1px solid black;
  margin-left:5%;
  background-color: grey;
  color: white;
  margin-top: 20px;
  margin-bottom: 30px;
  border-radius: 5px;
}
#btn1:hover {
  background-color: black;
  color: white;

}
.transferMoney{
        color:white;
        background-color: black ;
       
        padding: 20px;
        position:fixed;
        top:50%;
        left:50%;
        transform: translate(-50%, -50%);
    }
   
</style>
 
    
    
</head>
<body>
<!-- INCLUDING NAVBAR-->
<?php include('header.php'); ?>
<!-- Creating Form to collect information related to do transaction-->
<div class = 'transferMoney'>
    <h1>Transfer Money</h1>
    <!-- Form's action attribute points to this page only-->
    <!-- Note: To redirect page to samee php write "php echo $_SERVER['PHP_SELF'];" in action attribute-->
    <form name="myForm" action="result.php"  onsubmit=" validateForm()" method="post">
    <!-- To structurise form it is put in a table--onsubmit="return validateForm()"-->
        <table class="table1" >
        <!-- ROW 1 : PAYER ACCOUNT ID IS ASKED-->
        <tr>
            <td>Payer Account No</td>
            <td><input type="number" name="payerID"  min=100 required><td>
        </tr>
        <!-- ROW 2 : PAYEE ACCOUNT ID IS ASKED-->
        <tr>
            <td>Payee Account No</td>
            <td><input type="number" name="payeeID" min=100 required ><td>
        </tr>
        <!-- ROW 3 : AMOUNT TO BE TRANSFERRED IS ASKED-->
        <tr>
            <td>Amount (in Rupees)</td>
            <td><input type="number" name="amount" min=1 required><td>
        </tr>
        <!-- ROW 4 : BUTTON TO ASK TO CONFIRM TRANSACTION-->
        <tr>
            <td><input type= "hidden" name= "form_submitted" value="1"></td>
            <td> <input type="submit" value="PROCEED" id="btn1"><td>
        </tr>
       
        </table>
    </form>
</div>
      
        <!-- <div id="form_transfer">
        Payer's Name<input type="text"> 
    Payee's Name<input type="text">
    Payer's Account_No<input type="number">
    Payee's Account_No<input type="number">
    Amount<input type="number">

        </div> -->
    

    
    <script>
      function validateForm() {
       
        var payerID = document.forms["myForm"]["payerID"].value;
        var payerID = document.forms["myForm"]["payeeID"].value;
        var amount = document.forms["myForm"]["amount"].value;
      
        var regex = /^[0-9]+$/;
        // for verifying that the fileds must not be empty
        if(payerID=="" || payeeID=="" || amount==""){
          alert("All the Fields Must be Filled!");
          return false;
        }
        // verfying that value entered must not be invalid
        if(Math.sign(amount)==-1 || (Math.sign(amount)==-0)||z==0) {
          alert("enter a valid transaction");
          return false;
        }
        if(isNaN(amount)|| !payerID.match(regex)|| !payeeID.match(regex)){
          alert("enter correct input!!")
          return false;
        }

      }
    </script>
   
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>