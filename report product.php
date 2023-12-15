<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');

}
$select_users = $conn->prepare("SELECT * FROM `products`");
         $select_users->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="images/weblogo.png">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      body{
     /*    background:url(images/introbg.jpg);*/
      }

      h1{
    margin: 45px -40px -100px;
    padding: 43px;
    color: #000;
    text-align: center;
   
}
      #users {
         border-collapse: collapse;
         width: 450px;
         height: 100%;
         top: 20%;
         right: 1000%;
         margin: 0 auto;
      }
      td,th {
         border: 1px solid darkblue;
         padding: 10px;
      }
      #voters tr{
         background-color: #f2f2f2;
      }
      #voters tr:hover{
         background-color: limegreen;
      }
      th{
         background-color: lightsteelblue ;
         text-align: left;
         color: white;
      }
      button{
   margin-left: 285px;
   margin-top: 350px;

    width: 100px;
    height: 30px;
    padding: 0px 1px;
    font-size: 20px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: .2s ease-in;
    background-color: rgba(255,255,255,0.13);
    position: relative ;
    transform: translate(-50%,-50%);
    top: 10%;
   
    backdrop-filter: blur(30px);
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 15px rgba(8,7,16,0.6);
    z-index: 1;
    text-align: center;
    
}
button::before,
button::after{
   position: absolute;
   content: "";
   z-index: -1;
}
button:hover{
   background: #90EE90;
   box-shadow: 0 0 5px #000, 0 0 5px, 0 0 5px;
}

.buton{
   font-size: 11px;
}


   </style>

</head>
<body >
   
<?php include 'admin_header.php'; ?>
<header class="header">

   <div class="flex">
      



      
      <nav class="navbar">
         <a href="report.php" >Report</a>
          <a href="report product.php"style="color: green;">Report Product</a>
         
        
      </nav>

     
       </div>

</header>

<section class="user-accounts">

   <h1 class="title">total product</h1>

   <div class="box-container">
      <table id="users">
         
            <th>product name</th>
            <th>price</th>
            <th>category</th>
            <th>image</th>
            
           


      <?php
        
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <tr>

            <td><?= $fetch_users['name']; ?></td>
            <td><?= $fetch_users['price']; ?></td>
            <td><?= $fetch_users['category']; ?></td>
            <td><img src="uploaded_img/<?=$fetch_users['image']; ?>" alt="" style="border-radius: 15%;width:20px;height: 20px;"></td>
           
           
         </tr>




      
      <?php
      }
      ?>
   </div>

</section>
