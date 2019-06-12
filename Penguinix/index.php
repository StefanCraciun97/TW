<?php include("server.php"); ?>
<html>
    <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="login.css">
    </head>
    <body background="ptTW.png">
        <br/>
        <h1>penGUIniX Login</h1>
<div class="login">
    <br/>
    <img src="lock-icon.png" alt="lock-icon" style="float:left;width: 50px;height: 50px;">
    <br/> <br/> <br/> <br/>
    <?php include("errors.php"); ?>
    <form action="index.php" method="POST">
    <input type="text" name="user"
    placeholder="Introdu username">
    <br/> <br>
<input type="password" name="pass"
placeholder="Introdu parola">
<br/> <br/>
<input type="submit" value="Login" name='login' onclick="window.location.href='virtualmachine.html'" />
</form>
Don't have an account?<a href="register.php">Sign Up</a>
</div>
    </body>
</html>