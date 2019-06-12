<?php
include('server.php');
if (!isset($_SESSION['user_s'])) {
  header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="virtualmachine.css">
        <body background="ptTW1.svg">
</head>
<body>


<form action="logout.php">
    <input type="submit" name="log_out" value="Log out" />
</form>

<?php

$usernames = $_SESSION['user_s'];
$user_check_query2 = "SELECT Id from users WHERE Username='$usernames' LIMIT 1";
		$result = mysqli_query ($db , $user_check_query2);
		$user = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$idU=$user['Id'];
		$user_check_query = "SELECT idmachine from useraccess WHERE iduser=$idU";
		$result1 = mysqli_query ($db , $user_check_query);
		$count = 0;
		while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
			echo "<form>";
			$idV=$row['idmachine'];
			$user_check_query1 = "SELECT name,ip,os from virtualmachine WHERE idmachine='$idV'";
			$result2 = mysqli_query ($db , $user_check_query1);
			$user = mysqli_fetch_array($result2,MYSQLI_ASSOC);
			echo "<div class='div".++$count."'>";
			echo "<p><a href='functionalitati.html'><img src='computer.png' alt='computer image' href='functionalitati.html'></a></p>";
			echo "<p>".$user['name']."</p>";
			echo "<p>".$user['ip']."</p>";
			echo "<p>".$user['os']."</p>";
			echo "</div>";
			echo "</form>"; 
		}
		?>
</body>
</html>