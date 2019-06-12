<?php
session_start();
if (!isset($_SESSION['user_s'])) {
  header("Location: index.php");
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
if(isset($_POST['comandaTerm'])){
    /*
    //execute command through ssh and output in output.txt
    $command=$_POST['comandaTerm'];
    $ghilimele='"';
    $script="./a.out 11002 ".$ghilimele.$command.$ghilimele;
    echo $script;
    exec($script);

    //read output from output.txt

    /*$myfile = fopen("output.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("output.txt"));
    fclose($myfile);*/

    $command=$_POST['comandaTerm'];
    include ('Net/SSH2.php');
    $ssh = new Net_SSH2('84.117.124.45');
    if (!$ssh->login('username', 'password')) {
        exit('Login Failed');
    }
    $connection = ssh2_connect('84.117.124.45', 11002);
    ssh2_auth_password($connection, 'root', '1234');
    $stream = ssh2_exec($connection, 'pwd');

    echo $stream;
}
?>