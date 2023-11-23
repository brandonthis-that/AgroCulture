<?php
	if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == 1)
	{
		$loginProfile = "My Profile: ". $_SESSION['Username'];
		$logo = "glyphicon glyphicon-user";
		if($_SESSION['Category']!= 1)
		{
			$link = "Login/profile.php";
		}
		else {
				$link = "profileView.php";
		}
	}
	else
	{
		$loginProfile = "Login";
		$link = "index.php";
		$logo = "glyphicon glyphicon-log-in";
	}
?>

<!DOCTYPE html>
<header id="header" class="d-flex justify-content-between">
	<div id='farmsense'>
    <h4><a href="index.php">FarmSense</a></h4>
	</div>
	<div class="d-flex justify-content-around flex-grow-1">
    <nav id="nav">
        <ul class="d-flex justify-content-around flex-grow-1">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="myCart.php"><span class="glyphicon glyphicon-shopping-cart"> MyCart</a></li>
            <li><a href="market.php"><span class="glyphicon glyphicon-grain"> Digital-Market</a></li>
            <li><a href="blogView.php"><span class="glyphicon glyphicon-comment"> BLOG</a></li> 
        </ul>
    </nav>
	</div>
	<div><h4>Bankai</h4></div>
</header>
</html>
