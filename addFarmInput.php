<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST['type'];
    $productName = dataFilter($_POST['pname']);
    $productInfo = $_POST['pinfo'];
    $productPrice = dataFilter($_POST['price']);
    $investment = dataFilter($_POST['investment']);
    $return = dataFilter($_POST['return']);
    $fid = $_SESSION['id'];

    // Calculate profit
    $profit = $return - $investment;

    $sql = "INSERT INTO fproduct (fid, product, pcat, pinfo, price, investment, return, profit)
            VALUES ('$fid', '$productName', '$productType', '$productInfo', '$productPrice', '$investment', '$return', '$profit')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        $_SESSION['message'] = "Unable to upload Product !!!";
        header("Location: Login/error.php");
    } else {
        // Check if there is profit
        if ($profit > 0) {
            $_SESSION['message'] = "Successful investment! You made a profit of $profit";
        } else {
            $_SESSION['message'] = "Investment made, but no profit or a loss incurred.";
        }
        header("Location: market.php");
    }
}

function dataFilter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FarmSense</title>
    <!-- Add your other head elements here -->

    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="indexFooter.css">
    <link rel="stylesheet" href="login.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap\js\bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>

    <!-- Add any other scripts or styles you need -->
</head>
<body>

    <?php require 'menu.php'; ?>

    <section id="one" class="wrapper style1 align-center">
        <div class="container">
            <form method="POST" action="uploadProduct.php" enctype="multipart/form-data">
                <h2>Enter Your Farm Information here..!!</h2>
                <br>
                <center>
                    <!-- Add a dropdown for selecting category -->
                    <div class="select-wrapper" style="width: auto" >
                        <select name="type" id="type" required style="background-color:white;color: black;">
                            <option value="" style="color: black;">- Category -</option>
                            <option value="Crop" style="color: black;">Crop</option>
                            <option value="Animal" style="color: black;">Animal</option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                    <br />

                    <!-- Input fields for investment and return -->
                    <input type="text" name="investment" id="investment" value="" placeholder="Investment" style="background-color:white;color: black;" />
                    <br />
                    <input type="text" name="return" id="return" value="" placeholder="Return" style="background-color:white;color: black;" />
                    <br />
                </center>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="pname" id="pname" value="" placeholder="Product Name" style="background-color:white;color: black;" />
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="price" id="price" value="" placeholder="Price" style="background-color:white;color: black;" />
                    </div>
                </div>
                <br>
                <div>
                    <textarea  name="pinfo" id="pinfo" rows="12"></textarea>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="button fit" style="width:auto; color:black;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        CKEDITOR.replace('pinfo');
    </script>
</body>
</html>
