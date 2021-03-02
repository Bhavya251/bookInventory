<?php
    session_start();
    require("mysqli_connect.php");
    
    if(isset($_SESSION['login'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $bookID = $_SESSION['bookid'];
            $userID = $_SESSION['userid'];
            $quantity = $_POST['quantity'];
            $totalquantity = 0;
    
            $stmt = $conn->prepare("select * from books where bookID = ?");
            
            $stmt->bind_param("s", $bookID);
            
            $stmt->execute();
    
            $result = $stmt->get_result();
    
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $html = "<tr><td>".$row["bookname"]."</td><td>".$row["author"]."</td><td>".$quantity."</td><td>$".$row["unitprice"]."</td><td>$".($quantity * $row["unitprice"])."</td></tr>";
                    $totalquantity = $row["quantity"];
                }
            }    
    
            $stmt = $conn->prepare("update books set quantity = ? where bookID = ?");
            $totalquantity = $totalquantity - $quantity;
            
            $stmt->bind_param("ss", $totalquantity, $bookID);
            
            $stmt->execute();

             
            $stmt = $conn->prepare("insert into orders(userID, bookID) values(?,?)");
            $stmt->bind_param("ii", $userID, $bookID);
    
            if($stmt->execute()){
                $success = "Order Successfully placed";
            }
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
        <style>
            .container{
                background-color: #f2f2f2;
                padding: 5px 20px 15px 20px;
                border: 1px solid lightgrey;
                border-radius: 3px;
                margin-top: 40px;
                margin-bottom: 100px;
                width: 40%;                
            }
            
            table{
                width: 100%;
            }
            .success{
                color: #15cf18;
            }
        </style>
    </head>
    <body>
        <div class="container">
            
            <p><strong>Book(s)</strong></p>
        
            <table>
                <tr>
                    <th> Name </th>
                    <th> Author </th> 
                    <th> Quantity </th> 
                    <th> Unit Price </th>
                    <th> Total Price </th>
                </tr>
                <?php echo $html;?>
            </table>
            <br>
            <p class="success"><strong><?php echo $success; ?></strong></p>
        </div>
    </body>
</html>