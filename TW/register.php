<?php include("server.php"); ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="register.css">
</head>
<body background="ptTW.png">
        <br/>
        <h1>penGUIniX Register</h1>
<div class="register">
    <br/>
        <img src="pencil-icon.png" alt="pencil-icon" style="float:left;width: 50px;height: 50px; ">
        <br/> <br/> <br/> <br/>
        <?php include("errors.php"); ?>
        <?php if(!empty($success_message)) { ?>	
		<div class="success"><?php if(isset($success_message)) echo $success_message; ?>
        </div>
		<?php } ?>
   <form method="POST" action="register.php">
        <input type="text"placeholder="Your name.." name="fname">
    <br/> <br/>
        <input type="text"placeholder="Your last name.." name="lname">
    <br/> <br/>
        <input type="text"
        placeholder="Your e-mail" name="email">
        <br/> <br/>
            <input type="text"
            placeholder="Your username.." name="username">
            <br/> <br/>
                <input type="password"
                placeholder="Your password.." name = "password">
                <br/> <br/>
                <input type="submit" value="Register" name="register" onclick="window.location.href='virtualmachine.php'" />
                <br>
                <p>Aveti deja cont?
                <a href="index.php">Login</a>
    </form>
</div>
</body>
</html>