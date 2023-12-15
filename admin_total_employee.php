<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_employee'])){

   $emp_name = $_POST['emp_name'];
   $emp_name = filter_var($emp_name, FILTER_SANITIZE_STRING);
   $emp_id = $_POST['emp_id'];
   $emp_id = filter_var($emp_id, FILTER_SANITIZE_STRING);
   $emp_dob = $_POST['emp_dob'];
   $emp_dob = filter_var($emp_dob, FILTER_SANITIZE_STRING);
   $emp_gender = $_POST['emp_gender'];
   $emp_gender = filter_var($emp_gender, FILTER_SANITIZE_STRING);
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

   $select_employee = $conn->prepare("SELECT * FROM `employees` WHERE emp_id = ? AND emp_name = ?");
   $select_employee->execute([$emp_id, $emp_name]);

   if($select_employee->rowCount() > 0){
      $message[] = 'employee already exist!';
   }else{

      $insert_employee = $conn->prepare("INSERT INTO `employees`(emp_id, emp_name, emp_dob, emp_gender, contact_no, address, emp_designation, image) VALUES(?,?,?,?,?,?,?,?)");
      $insert_employee->execute([$emp_id, $emp_name, $emp_dob, $emp_gender, $contact_no, $address, $emp_designation, $image, ]);

      if($insert_employee){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new employee added!';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `employees` WHERE emp_id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);

    

   $delete_employee = $conn->prepare("DELETE FROM `employees` WHERE emp_id = ?");
   $delete_employee->execute([$delete_id]);
  
   
   header('location:admin_total_employee.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png" href="images/weblogo.png">
   <title>employee</title>

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



<section class="user-accounts">

   <h1 class="title">employees</h1>

   <div class="box-container">

   <?php
      $show_emp_info = $conn->prepare("SELECT * FROM `employees`");
      $show_emp_info->execute();
      if($show_emp_info->rowCount() > 0){
         while($fetch_emp_info = $show_emp_info->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box" style="border-block: none;  background-color: rgba(255, 255, 255, 0.8);border-radius: 2rem;">
      <div class="emp_id">
         <p><span style="font-size: 40px;"><?= $fetch_emp_info['emp_id']; ?></span></p>
      </div>
      <img src="uploaded_img/<?= $fetch_emp_info['image']; ?>" alt="" style="border-radius: 35%;">
      <div class="emp_name">
         <p><span style="color:var(--green);"><?= $fetch_emp_info['emp_name']; ?></span></p>
       </div>
      <div class="emp_designation">
          <p><span style="color:var(--green);"><?= $fetch_emp_info['emp_designation']; ?> </span></p>
       </div>
     
      

      <div class="flex-btn">
         <a href="admin_update_employee.php?update=<?= $fetch_emp_info['emp_id']; ?>" class="option-btn">update</a>
      </div>
            <div class="flex-btn">
         <a href="admin_total_employee.php?delete=<?= $fetch_emp_info['emp_id']; ?>" class="delete-btn" onclick="return confirm('delete this employee info?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no employees added yet!</p>';
   }
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>