<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>
<style>
   body{
      background-image: url('images/admin bg1.jpg' );
      background-size: 120% 150%;
   </style>

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container" >

      

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>orders placed</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>products added</p>
      <a href="admin_products.php" class="btn">see products</a>
      </div>

      <div class="box" style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_employee = $conn->prepare("SELECT * FROM `employees`");
         $select_employee->execute();
         $number_of_employee = $select_employee->rowCount();
      ?>
     <h3><?= $number_of_employee; ?></h3>
      <p>employees</p>
      <a href="admin_employee.php" class="btn">add employee</a>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_users->execute(['user']);
         $number_of_users = $select_users->rowCount();
      ?>
      <h3><?= $number_of_users; ?></h3>
      <p>total users</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_admins->execute(['admin']);
         $number_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $number_of_admins; ?></h3>
      <p>total admins</p>
      <a href="admin_admins.php" class="btn">see accounts</a>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_accounts = $conn->prepare("SELECT * FROM `users`");
         $select_accounts->execute();
         $number_of_accounts = $select_accounts->rowCount();
      ?>
      <h3><?= $number_of_accounts; ?></h3>
      <p>total accounts</p>
      <a href="admin_account.php" class="btn">see accounts</a>
      </div>

      <div class="box" style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `employees`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>total employees</p>
      <a href="admin_total_employee.php" class="btn">total employees</a>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `message`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>total messages</p>
      <a href="admin_contacts.php" class="btn">see messages</a>
      </div>
        <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         };
      ?>
      <h3>&#x20B9;<?= $total_pendings; ?>/-</h3>
      <p>total pendings</p>
      </div>

      <div class="box"style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completed->execute(['completed']);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
            $total_completed += $fetch_completed['total_price'];
         };
      ?>
      <h3>&#x20B9;<?= $total_completed; ?>/-</h3>
      <p>completed orders</p>
      </div>

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>