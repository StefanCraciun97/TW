<?php
session_start();
if (!isset($_SESSION['user_s']) || !isset($_SESSION['machine'])) {
  header("Location: logout.php");
}
?>

<html>
    <head>

        <body>
            <a href="logout.php">Logout</a>
            <div class="div1">
                <p>Introduceti comanda</p>
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
echo $port;
if(isset($_POST['comandaTerm'])){
    
    $command = $_POST['comandaTerm'];
    //read output from output.txt
    exec('./webserver.out '.$port.' "'. $command . '"');

    $myfile = fopen("out.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("out.txt"));
    fclose($myfile);

    
}
?>