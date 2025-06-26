<?php
session_start(); // Start session to store user info after login

include "database.php";

if (isset($_POST['submit'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password']; // Not encrypted so it will reflect in the Database

  $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {

    $user = mysqli_fetch_assoc($result);

    $_SESSION['loggedin'] = true;
    $_SESSION['userID'] = $user['id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['accType'] = $user['accType'];

    if ($user['accType'] === 'Logistics') {
      header("Location: logistics.php");
    } elseif ($user['accType'] === 'Production') {
      header("Location: production.php");
    } elseif ($user['accType'] === 'Warehouse') {
      header("Location: warehouse.php");
    } else {

      header("Location: index.php");
    }
    exit;
  } else {
    $error = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom Styles -->
  <link href="styles.css" rel="stylesheet">

</head>

<body>
  <div class="login-container d-flex align-items-center justify-content-center">
    <div class="position-fixed top-0 start-0 px-5 py-4">
      <a href="index.php"> <img src="Assets\logo.png" alt="InStock Logo" style="height: 30px;"> </a>
    </div>

    <!-- Login Form -->
    <div class="login-form">
      <h2 class="text-center fw-bold">Login</h2>
      <p class="text-center" style="color: #6c757d;">Your Inventory, Always in Stock</p>
      <form action="index.php" method="post">
        <!-- Email Input -->
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="john.doe@example.com">
        </div>

        <!-- Password Input -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="********">
        </div>

        <!-- Login Button -->
        <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
      </form>

      <!-- Forgot Password Link -->
      <div class="create-account">
        Not regestered yet? <a href="register.php">Create new account</a>
      </div>
    </div>

    <!-- Image Section -->
    <div class="login-image"></div>
  </div>

</body>

</html>