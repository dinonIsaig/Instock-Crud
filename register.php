<?php
include "database.php";

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $accType = $_POST['account_type'];

    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result_check = mysqli_query($conn, $check_email);
    
    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Email already exists!');</script>";
        exit;
    }

    $sql = "INSERT INTO user (first_name, last_name, email, password, accType) VALUES ('$first_name','$last_name','$email','$pass', '$accType')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: index.php?msg=New record created successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet">
  
  <!-- Custom Styles -->
  <link href="styles.css" rel="stylesheet">
  
</head>
<body>
  
  <!-- Background Image Section -->
  <div class="d-flex h-100">
    <div class="bg-image"></div>

     <!-- Logo -->
    <div class="w-75 d-flex flex-column justify-content-center">
      <div class = "position-fixed top-0 start-5 px-5 py-4">
        <a href="index.php"> <img src="Assets\logo.png" alt="InStock Logo" style="height: 30px;"> </a>
      </div>

      <!-- Form Section -->
      <div class="d-flex align-items-center justify-content-center">
         <div class="form-container">
               
               
               <!-- Form Title -->
               <h2 class="form-title">Sign Up</h2>
               <p class="form-subtitle">Join Instock and take control of your inventory!</p>

               <!-- Sign-Up Form -->
               <form action="register.php" method="post">
                  <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="firstName" class="form-label">First Name*</label>
                        <input type="text" name ="first_name" class="form-control" id="firstName" placeholder="John" required>
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="lastName" class="form-label">Last Name*</label>
                        <input type="text" name ="last_name" class="form-control" id="lastName" placeholder="Smith" required>
                     </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" name ="email" class="form-control" id="email" placeholder="johnsmith@gmail.com" required>
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" name ="password" class="form-control" id="password" placeholder="minimum 8 characters" required>
                     </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="inventoryType" class="form-label">Select Inventory Type*</label>
                     <select class="form-select" name ="account_type" id="inventoryType" required>
                     <option value="">Choose Option</option>
                     <option value="Warehouse">Warehouse</option>
                     <option value="Logistic">Logistic</option>
                     <option value="Production">Production</option>
                     </select>
                  </div>

                  <!-- Submit Button -->
                  <button name ="submit" type="submit" class="btn btn-signup mt-3">Sign Up</button>

                  <!-- Already Have an Account Link -->
                  <div class="already-account mt-3">
                     Already have an account? <a href="index.php">Log in</a>
                  </div>
               </form>
            </div>
      </div>
        
    </div>
  </div>

</body>
</html>



