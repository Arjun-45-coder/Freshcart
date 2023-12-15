<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_employee'])){

   $emp_id = $_POST['emp_id'];
   $emp_id = filter_var($emp_id, FILTER_SANITIZE_STRING);
   $emp_name = $_POST['emp_name'];
   $emp_name = filter_var($emp_name, FILTER_SANITIZE_STRING);
   $emp_dob = $_POST['emp_dob'];
   $emp_dob = filter_var($emp_dob, FILTER_SANITIZE_STRING);
   $contact_no = $_POST['contact_no'];
   $contact_no = filter_var($contact_no, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $emp_designation = $_POST['emp_designation'];
   $emp_designation = filter_var($emp_designation, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   $update_employee = $conn->prepare("UPDATE `employees` SET emp_name = ?, emp_dob = ?, contact_no = ?, address = ?, emp_designation = ?  WHERE emp_id = ?");
   $update_employee->execute([$emp_name, $emp_dob, $contact_no, $address, $emp_designation, $emp_id]);

   $message[] = 'employee updated successfully!';

   if(!empty($image)){
      if($image_size > 20000000000000){
         $message[] = 'image size is too large!';
      }else{

         $update_image = $conn->prepare("UPDATE `employees` SET image = ? WHERE emp_id = ?");
         $update_image->execute([$image, $emp_id]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image updated successfully!';
         }
      }
   }

  /* if(!empty($book_file)){
      

         $update_book_file = $conn->prepare("UPDATE `products` SET book_file = ? WHERE id = ?");
         $update_book_file->execute([$book_file, $pid]);

         if($update_book_file){
            move_uploaded_file($book_file_tem_loc,$book_file_store);
            unlink('book_file/'.$old_image);
            $message[] = 'book file updated successfully!';
         }
      }
   
*/







}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="images/weblogo.png">
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      body{
         background:url(images/introbg.jpg);
      }
   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update employee</h1>   

   <?php
      $update_id = $_GET['update'];
      $select_employee = $conn->prepare("SELECT * FROM `employees` WHERE emp_id = ?");
      $select_employee->execute([$update_id]);
      if($select_employee->rowCount() > 0){
         while($fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_employee['image']; ?>">
      <input type="hidden" name="emp_id" value="<?= $fetch_employee['emp_id']; ?>">
      <img src="uploaded_img/<?= $fetch_employee['image']; ?>" alt="">
      <input type="text" name="emp_name" placeholder="enter employee name" required class="box" value="<?= $fetch_employee['emp_name']; ?>">
      <input type="date" name="emp_dob"  placeholder="emp_dob" required class="box" value="<?= $fetch_employee['emp_dob']; ?>">
      <input type="number" name="contact_no" class="box" value="<?= $fetch_employee['contact_no']; ?>">
      <textarea  name="address" cols="30" class="box" rows="10"><?= $fetch_employee['address']; ?></textarea>
      <select name="emp_designation" class="box" value="<?= $fetch_employee['emp_designation']; ?>" required>
         <option selected><?= $fetch_employee['emp_designation']; ?></option>
          <option value="Store manager">Store manager</option>
               <option value="Delivery Boy">Delivery boy</option>
               
              
              
             
      </select>


     
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
       
      <div class="flex-btn">
         <input type="submit" class="btn" value="update employee" name="update_employee">
         <a href="admin_total_employee.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>













<script src="js/script.js"></script>

</body>
</html>