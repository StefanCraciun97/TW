<?php include("servervm.php"); ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="register.css">
            <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
input[type=submit]
{
    padding:10px 113px;
}

.topnav {
  overflow: hidden;
  background-color: rgba(9, 33, 41, 0.2);
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
  background-color:#ddd;
  color: black;
}


</style>
</head>
<body background="ptTW.png">
<div class="topnav">
  <a href="logout.php">Log out</a>
  
</div>

        <br/>
        <h1>penGUIniX Virtual Machine</h1>
<div class="register">
    <br/>
        <img src="pencil-icon.png" alt="pencil-icon" style="float:left;width: 50px;height: 50px; ">
        <br/> <br/> <br/> <br/>
        <?php include("errors.php"); ?>
        <?php if(!empty($success_message)) { ?>	
		<div class="success"><?php if(isset($success_message)) echo $success_message; ?>
        </div>
		<?php } ?>
   <form method="POST" action="vm.php">
        <input type="text"placeholder="Name" name="namevm">
    <br/> <br/>
        <input type="text"placeholder="IP" name="ip">
    <br/> <br/>
        <input type="text"
        placeholder="OS" name="os">
        <br/> <br/>
        <input type="text"
        placeholder="Nume utilizator acces" name="useraccess">
        <br/> <br/>
        <input type="password"
        placeholder="Root password" name="root">
        <br/> <br/>
                <input type="submit" style="background-color=blue" value="Add Machine" class="add" name="addmachine" onclick="window.location.href='virtualmachine.html'" />
                <!-- <button class="buton2">Register</button> -->
    </form>




</div>
</body>
</html>