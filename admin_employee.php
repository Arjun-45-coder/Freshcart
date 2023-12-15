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
      $insert_employee->execute([$emp_id, $emp_name, $emp_dob, $emp_gender, $contact_no, $address, $emp_designation, $image]);

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
  
   
   header('location:admin_employee.php');


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

<section class="add-products">

   <h1 class="title">add-new-employee</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <input type="text" name="emp_id" class="box" required placeholder="enter employee id">
         <input type="text" name="emp_name" class="box" required placeholder="enter employee name">
          <select autocomplete="off" name="emp_designation" class="box" required value="designation">
   <option selected hidden value="">Select the designation</option>
   <option value="Store Manager">Store Manager</option>
   <option value="Delivery Boy">Delivery Boy</option>
   </select>
   <h1>Date of Birth</h1>
         <input type="date" name="emp_dob" class="box" required placeholder="date-of-birth">
          <input type="number" name="contact_no" class="box" required placeholder="enter employee contact">
       </div>
       <div class="inputBox">
         <textarea type="text" name="address" class="box" required placeholder="enter employee address" cols="30" rows="100"></textarea>
          <select autocomplete="off" name="emp_gender" class="box" required value="gender">
   <option selected hidden value="">Select the gender</option>
   <option value="Male">Male</option>
   <option value="Female">Female</option>
   <option value="Other">Other</option>
   </select>
         
        
        <br> <h1>Profile Image</h1>
         <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png"/><br>
         


         


         </div>
      </div>
      
      <input type="submit" class="btn" value="add employee" name="add_employee">
   </form>

</section>


   <?php
      
   
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>