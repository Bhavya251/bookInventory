<?php
    session_start();
    require("mysqli_connect.php");

    $error = "";

    if(isset($_SESSION['login'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $bookname = mysqli_real_escape_string($conn, $_POST['bookname']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
            $unitprice = mysqli_real_escape_string($conn, $_POST['unitprice']);
    
            if($password === $cpassword){
                $password = md5($password);
    
                $stmt = $conn->prepare("insert into books(bookname, author, quantity, unitprice) values(?,?,?,?)");
                $stmt->bind_param("ssss", $bookname, $author, $quantity, $unitprice);
    
                if($stmt->execute()){
                    header("Location: order.php");
                }
            }
            else{
                $error = "Something must have gone worng";
            }    
        }
    }
    else{
        header("Location: index.php");
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Book Inventory</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="order.php">Home <span class="sr-only">(current)</span></a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addBook.php">Add Book</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a href="index.php">Sign Out</a>
                </span>
            </div>
        </nav>
        <div class="card mx-auto" style="width: 25rem; margin-top: 80px;">	  
                <div class="card-body">
                    <p class="card-text">
                        <form action="addBook.php" method="POST">

                        <?php echo $error; ?>

                                <label for="bookname">Book Name:</label>
                                <input type="text" class="form-control" name="bookname" id="bookname" placeholder="Enter Bookname" required/>
                                
                            <br>
                            
                                <label for="author">Author:</label>
                                <input type="text" class="form-control" name="author" id="author" placeholder="Enter Author" required/>
                            
                            <br>

                                <label for="quantity">Quantity:</label>
                                <input type="number" min="1" max="1000" maxlength="4" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity" required/>
    
                            <br>

                                <label for="unitprice">Unit Price:</label>
                                <input type="text" class="form-control" name="unitprice" id="unitprice" placeholder="Enter Unit Price" required/>

                            <br>                                

                                <button class="btn btn-primary" name="submit" value="submit"><i class="fa fa-lock">&nbsp;</i>Register</button>
                        </form>	

                    </p>		    	
                </div>
        </div>
    </body>
</html>