<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-5.png" alt="">
         <h3>why choose us?</h3>
         <p>The purpose of Freshcart is not only the availability of a wide range of different products. But we offer a lower price as well as fresh products on your finger</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-4.png" alt="">
         <h3>what we provide?</h3>
         <p> We provide browse the firm's range of products and services, view photos or images of the products, along with information about the product specifications, features and prices.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>The online shopping platform offers an extensive range of products across various categories.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>vishnu</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>The user-friendly interface and well-organized layout make it easy to find products and compare options.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>sreelakshmi</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p> I am consistently impressed by the quality of the products I've purchased from the platform. </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Abhiraj</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>The care taken in packaging the products is evident. Each item is securely packed, ensuring they arrive in perfect Time.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>clara</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>The pricing is transparent, without any hidden fees or surprises during checkout. High-Quality Products</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>febin</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Overall, I am extremely satisfied with the online shopping platform and its products. The platform's commitment to quality</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>clitty</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>