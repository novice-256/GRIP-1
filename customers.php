<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"  crossorigin="anonymous">

    <link rel="icon" href="assets/img/logo.png" type="image/png"/>
<title>Bank App</title>

  </head>
  <body>

<section class="container content border my-5 " style="height:80vh overflow-X:scroll">
<nav aria-label="breadcrumb-sec">

    
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index">Home</a></li>
  <li class="breadcrumb-item "><a href="customers" >View All Customers</a></li>

</ol>
</nav>


<div class="row w-100  flex-column justify-content-center  mx-auto align-items-center " >
    <!-- Content goes here -->
    <h2 class=" p-3 ">Select to view or transfer</h2>
    
</div>
<div class="customers-area  ">
<table class="table ">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Email </th>

        <th scope="col">Contact Details</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
     
    <?php 
  include_once 'config/config.php';
  session_start();
  if(!isset( $_SESSION['logged_user'])){
    echo " <script>
    alert('you need to visit home first')
  </script>";
  }
 $user_id = $_SESSION['logged_user'];
  $query= "select * from customers where cust_id != $user_id";
  $statement = $con->prepare($query);
 $statement->execute();

  $data = $statement->get_result();
  
   while($row= $data->fetch_assoc()): ?>
      <tr>
        <th scope='row'>1</th>
        <td><?= $row['cust_name'] ?></td>
        <td><?= $row['cust_email'] ?></td>
        <td><?= $row['cust_phone'] ?></td>

        <td> <a href='transfer-money?id=<?= $row['cust_id'] ?>'> <button class='btn  btn-outline-primary'><i class='fa-solid fa-money-bill-transfer'></i> Transfer</button></a></td>
      </tr>
      </tbody>
      
      <?php 
      endwhile ;
  
      ?>
      
  </table>
</div>
<footer class="text-center">
        <p>&copy; 2023 Your Company Name. All rights reserved.</p>
    </footer>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>