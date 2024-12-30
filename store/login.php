<?php
require('connection.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 300px;
      width: 100%;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin:10px 0;
      box-sizing: border-box;
    }

    input[type="submit"],
    input[type="button"] {
      background-color: #198754;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      width: 100%;
    }

    input[type="submit"]:hover,
    input[type="button"]:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email=? AND user_password=?");
    $stmt->bind_param("ss", $user_email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $user_first_name = $data['user_first_name'];
      $user_last_name = $data['user_last_name'];
      $_SESSION['user_first_name'] = $user_first_name;
      $_SESSION['user_last_name'] = $user_last_name;
      header('location: index.php');
      exit();
    } else {
      $login_error = 'Invalid login credentials';
    }

    $stmt->close();
  }

  ?>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <?php if (isset($login_error)): ?>
      <p class="error">
        <?php echo $login_error; ?>
      </p>
    <?php endif; ?>

    User's Email:<br>
    <input type="text" name="user_email" required><br>
    User's Password:<br>
    <input type="password" name="user_password" required><br>
    <input type="submit" value="Login">

    <!-- <a href="signup.php" class="signup-link" style="display: block; text-align: center; margin-top: 10px; text-decoration: none; color: #333;">Don't have an account? Sign up here</a> -->
  </form>

</body>

</html>