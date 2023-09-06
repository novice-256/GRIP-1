<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="assets/img/logo.png" type="image/png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  crossorigin="anonymous">

<title>Bank App</title>

  </head>
  <body>
  <style>
 .input[type]:focus{
    
      outline : none

        }
 ul li{
  font-size: 11pt ;
   line-height:1.7em
}
        *{
          box-sizing:border-box !important;
        }
        
.message-box {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    text-align: center;
}

.message-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.message-content i {
    font-size: 48px;
    color: #4CAF50; /* Green color for success */
}

button.ok-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    margin-top: 20px;
}

button.ok-button:hover {
    background-color: #45a049;
}
    </style>
    <?php

       include_once 'config/config.php';
       session_start();
        
       $query= "SELECT * 
       FROM (
           SELECT * 
           FROM customers
            JOIN account USING(cust_id)
       ) AS joined_data 
       WHERE joined_data.cust_id = ?;
       ";
       $statement = $con->prepare($query);
       $statement->bind_param('s',$_GET['id']);
       
       $statement->execute();
      
  $data = $statement->get_result();
  
  $row= $data->fetch_assoc(); 

if(isset($_POST['btn'])):
  $query= "insert into transactions (cust_id ,acc_id ,amount,sender_id) values (?, ? ,?, ?)";
  $statement = $con->prepare($query);
$amount = ctype_digit($_POST['amount'])?$_POST['amount']:"";
$cust_id = $_GET['id'];
$acc_id = $row['acc_id']; 
$sender_id = $_SESSION['logged_user'];
if( $amount !="" ):
$statement->bind_param('iiii',$cust_id,$acc_id,$amount,$sender_id);
$statement->execute();
endif;

if($statement->affected_rows && $amount):
$success = "Your Transaction was Completed" ;
?>
<script>var showDialog = true</script>
<?php 
elseif($amount==""  ):
  $null_error = "please enter valid amount" ;
  
endif;

endif;

  
     ?>
    <section class="container content border py-6 my-3" style="height:80vh">
<nav aria-label="breadcrumb-sec">

    
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index">Home</a></li>
  <li class="breadcrumb-item  "><a href="customers">View All Customers</a></li>
  <li class="breadcrumb-item  " aria-current="page"><a href="Transfer-money">Transfer Money </a> </li>
</ol>
</nav>

<div class="row justify-content-center h-100 border ger align-items-center ">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body ">
      <h5 class="card-title text-center ">ACCOUNT INFORMATION</h5>
       

            <div scope="row" class="border d-flex justify-content-around">
          <div class="col-6 my-2 p-2">

          <strong>  Account Title :</strong>
            </div>  
          <div class="col-6 my-2 p-2">

          <pre><span class="px-3"><?= $row['cust_name']  ?></span></pre>
          </div>
            
            
            

      </div>
        
     

      <div scope="row" class="border d-flex justify-content-around">
      <div class="col-6">

      <strong> IBAN :</strong>
          </div>
      <div class="col-6 my-2 p-2">
            
          
      <pre><span class="px-3"><?= $row['iban'] ?></span></pre>
             
          </div>
            
            

      </div>
      <div scope="row" class="' d-flex justify-content-around">
        
        <div class="col-6 my-2 p-2 '">



<h5 class="text-center "> Enter Amount </h5>


    <form action="" method="post" class="form" >
        <input type="number" class="input  form-control border-top-0 border-left-0 border-right-0 border-secondary border-bottom-1" name="amount"
        >
    <?php if(!empty($null_error)):?>    <span class=" text-danger mt-2 p-1"><strong><?= $null_error?></span> </strong> <?php endif ?>
        <input type="submit" class="btn form-control btn-primary text-center  d-block col-md-8 col-sm-12 my-4 mx-auto" name="btn"   value="CLICK TO PAY">
    </form>  
  
  </div>
    </div>
 </div>
  <div class="col-sm-12 text-center"> 
    <div class="card border-0">
      <div class="card-body">
      <h4 class="card-title "><i class="fa-solid fa-triangle-exclamation text-warning mx-2 3"></i>Important Instruction</h4>
        <ul class=" text-muted text-center list-unstyled" >
          <li class="">1. Verify Details: Double-check recipient, amount, and notes.</li>
          <li class="">2. Ensure Funds: Confirm sufficient balance in your account.</li>
          <li class="">3. Use Secure Connection: Ensure a secure website or app.</li>
          <li class="">4. Keep Confirmation: Save transaction receipt for reference.</li>

        </ul>
    
      </div>
    </div>
  </div>
   
</div>

<footer class="text-center">
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <div class="message-box">
        <div class="message-content">
        <?php if( !empty($success) ):?>
          
          <i class="fas fa-check-circle"></i>
              <p>Success!<?= $success?>.</p>
            <button id="ok-button" class="ok-button">OK</button>

          <?php else:?>
            <i class="fa-solid fa-exclamation text-danger"></i> 
            <p class="text-danger">Error!<?= "Something went wrong try again. "?></p>

            <button id="ok-button" class="btn btn-danger">OK</button>
                <?php endif ?>
              
        </div>
    </div>
    <script>

if(showDialog){

  $(document).ready(function() {
    // Show the message box
    $(".message-box").show();
    
    // Hide the message box when the "OK" button is clicked
    $("#ok-button").click(function() {
      $(".message-box").hide();
    });
  });
}
</script>
</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>



