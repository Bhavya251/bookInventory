<?php
    session_start();
    require("mysqli_connect.php");

    $html = "";

    if(isset($_SESSION['login'])){
        $bookID = $_SESSION['bookid'];

        $bookname = "";

        $stmt = $conn->prepare("select bookname from books where bookID = ?");
        
        $stmt->bind_param("s", $bookID);
        
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $bookname = $row["bookname"];
            }
        }
        else{
            echo "0 entries";
        }
    }
    else{
        header("Location: index.html");
    }

    $conn->close();
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
                    <form action="final.php" method="POST">

                            <label for="Book ID">Book ID:</label>
                            <input type="text" class="form-control" name="bookid" value="<?php echo $bookID; ?>" placeholder="Book ID" disabled required/>
                                
                        <br>                            
                                                        
                            <label for="Book Name">Book Name:</label>
                            <input type="text" class="form-control" name="bookname" value="<?php echo $bookname; ?>" placeholder="Book Name" disabled required/>
                            
                        <br>                                                        
                                                        
                            <label for="Quantity">Quantity:</label>
                            <input type="number" min="1" max="5" maxlength="1" class="form-control" name="quantity" placeholder="Total Quantity" required/>
                            
                        <br>
                            
                            <label for="Name on Card">Name on Card:</label>
                            <input type="text" class="form-control" name="namecard" placeholder="Name on Card" required/>
                            
                        <br>
                            
                            <label for="expirydate">Expiry Date:</label>
                            <input type="text" class="form-control" name="expirydate" placeholder="Expiry Date" required/>
                            
                        <br>
                            
                            <label for="Name on Card">CVV:</label>
                            <input type="text" class="form-control" maxlength="3" name="namecard" placeholder="CVV" required/>
                            
                        <br>
                            
                            <label for="Name on Card">Postal:</label>
                            <input type="text" class="form-control" name="namecard" placeholder="Postal" required/>
                            
                        <br>

                        <button class="btn btn-primary" name="submit" value="submit">Checkout</button>
                    </form>	

                </p>		    	
            </div>
        </div>
    </body>
</html