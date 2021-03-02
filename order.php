<?php
    session_start();

    require("mysqli_connect.php");

    if(isset($_SESSION['login'])){
        
        $stmt = $conn->prepare("select * from books");

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "<table class='table table-striped table-bordered'><tr><th>ID</th><th>Book Name</th><th>Author</th><th>Quantity</th></tr>";
            while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row["bookID"]."</td><td>".$row["bookname"]."</td><td>".$row["author"]."</td><td>".$row["quantity"]."</td></tr>";
            }
        }
        else{
            echo "0 entries";
        }
    }
    else{
        header("Location: index.html");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!is_numeric($_POST['buyID'])){
            echo "<script>alert('Please enter numeric value');</script>";
        }
        else{
            $_SESSION['bookid'] = $_POST['buyID'];
            header("Location: checkout.php");
        }
    }
    
    $conn->close();
?>

<html>
    <head>
        <style>
            .table {
                width: 60%;
                margin-bottom: 1rem;
                color: #212529;
                float: left;
                margin-left: 20%;
                margin-top: 60px;
                text-align: center;
            }
            .table-bordered {
                border: 1px solid #dee2e6;
            }
            .table-striped tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }
            .table-bordered tr:hover {
                color: #212529;
                background-color: rgba(0, 0, 0, 0.075);
            }


            input, label{
                margin-top: 50px; 
                margin-left: 25px;               
            }
            .btn {
                display: inline-block;
                font-weight: 400;
                color: #212529;
                text-align: center;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 0.9rem;
                line-height: 1.5;
                border-radius: 0.25rem;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                margin-left: 15px;
            }

            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
            }

            .btn-primary:focus, .btn-primary.focus {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
                box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
            }
        </style>
    </head>
    <body>
        <form action="order.php" method="POST">
            <label for="buyID">Enter book ID to buy: <input type="text" name="buyID" placeholder="Enter book ID"></label>
            <button class="btn btn-primary" name="submit" value="submit">Buy</button>
        </form>
        
    </body>
</html>