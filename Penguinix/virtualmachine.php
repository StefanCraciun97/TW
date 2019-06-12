<?php
session_start();
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
        <p>You are logged in as <?php echo $_SESSION['user_s']?></p>
        <a href="logout.php">Logout</a>
        <h1>Choose a machine to configure!</h1>
        <div class="div1">
        <p><a href="terminal.php"><img src="computer.png" alt="computer image" href="terminal.php"></a></p>
        <p>Nume_masina1</p>
        <p>IP:234.123.1.23</p>   
        <p>SO:Linux</p>
        <p>ON</p>
     </div>
     <div class="div2">
        <p><a href="terminal.php"><img src="computer.png" alt="computer image" href="terminal.php"></a></p>
            <p>Nume_masina1</p>
            <p>IP:214.113.21.56</p>   
            <p>SO:Windows</p>
            <p>OFF</p>
     </div>
<div class="div3">
        <p><a href="terminal.php"><img src="computer.png" alt="computer image" href="terminal.php"></a></p>
        <p>Nume_masina1</p>
        <p>IP:234.123.1.23</p>   
        <p>SO:Linux</p>
        <p>OFF</p>
</div>
<div class="div4">
        <p><a href="terminal.php"><img src="computer.png" alt="computer image" href="terminal.php"></a></p>
        <p>Nume_masina1</p>
        <p>IP:214.255.123.31</p>   
        <p>SO:Windows</p>
        <p>ON</p>
</div>
    </body>
</head>
</html>