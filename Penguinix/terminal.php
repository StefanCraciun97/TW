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
    $command=$_POST['comandaTerm'];
    $ghilimele='"';
    $script="./a.out 11002 ".$ghilimele.$command.$ghilimele;
    echo $script;
    exec($script);
}
?>