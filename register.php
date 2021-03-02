<?php

    require("mysqli_connect.php");

    $error = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $postal = mysqli_real_escape_string($conn, $_POST['postal']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        if($password === $cpassword){
            $password = md5($password);

            $stmt = $conn->prepare("insert into users(fullname, address, postal, email, username, password) values(?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $fullname, $address, $postal, $email, $username,$password);

            if($stmt->execute()){
                header("Location: index.html");
            }
            else{
                echo "<p style='color: red;'>Failed</p>";
            }
        }
        else{
            $error = "Password and Confirm Password must be same";
        }


    }

?>

<html>
    <head>
        <title>Book Inventory</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>        
    </head>
    <body>
        <div class="card mx-auto" style="width: 25rem; margin-top: 80px;">	  
                <div class="card-body">
                    <p class="card-text">
                        <form action="register.php" method="POST">

                        <?php echo $error; ?>

                                <label for="Username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required/>
                                
                            <br>
                            
                                <label for="Password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required/>
                            
                            <br>

                                <label for="ConfirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Confirm Password" required/>
    
                            <br>

                                <label for="Fullname">Fullname:</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Fullname" required/>

                            <br>

                                <label for="Address">Address:</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required/>

                            <br>

                                <label for="Postal">Postal:</label>
                                <input type="text" class="form-control" name="postal" id="postal" placeholder="Enter Postal Code" required/>

                            <br>

                                <label for="Email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required/>

                            <br>

                                <button class="btn btn-primary" name="submit" value="submit"><i class="fa fa-lock">&nbsp;</i>Register</button>
                        </form>	

                    </p>		    	
                </div>
        </div>
    </body>
</html>