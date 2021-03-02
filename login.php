<?php
    session_start();
    session_unset();

    require("mysqli_connect.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = md5($password);


      $stmt = $conn->prepare("select * from users where username = ? and password = ?");

      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      
      if($result = $stmt->get_result()){
        $_SESSION['login'] = $username;
        header("Location: order.php");
      }
      else{
        echo "<p style='color: red;'>Failed</p>";
      }
    }
    else{

    }
?>