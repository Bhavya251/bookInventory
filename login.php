<?php
    session_start();

    require("mysqli_connect.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = md5($password);


      $stmt = $conn->prepare("select * from users where username = ? and password = ?");

      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      
      if($result = $stmt->get_result()){

        $row = $result->fetch_assoc();
        if($row['password'] == $password){
          $_SESSION['login'] = $username;
          $_SESSION['userid'] = $row['userID'];
          header("Location: order.php");
        }        
      }
      else{
        echo "<p style='color: red;'>Failed</p>";
      }
    }
    else{

    }
    $conn->close();
?>