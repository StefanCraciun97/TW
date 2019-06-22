<?php
session_start();
if (!isset($_SESSION['user_s']) || !isset($_SESSION['machine'])) {
  header("Location: logout.php");
}
?>

<html>
    <head>
    <link rel="stylesheet" href="terminal.css">
    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}


</style>
        <body background="ptTW1.svg">
        <div class="topnav">
  <a href="logout.php">Log out</a>
  
</div>
            <div class="div1">
                
                <form method="POST">
                    <input type='text' name='comandaTerm'>
	            </form>
            </div>

            <div class="comanda">
                <p>Output Comanda</p>
                
            </div>
            
        </body>
    </head>
</html>

<?php 

$port = $_SESSION['machine']+11000;
//echo $port;
if(isset($_POST['comandaTerm'])){
    
    $command = $_POST['comandaTerm'];
    //read output from output.txt
    exec('./webserver.out '.$port.' "'. $command . '"');

    $myfile = fopen("out.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("out.txt"));
    fclose($myfile);

    
}
?>