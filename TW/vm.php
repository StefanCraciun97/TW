<?php include("servervm.php"); ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="register.css">
</head>
<body background="ptTW.png">
        <br/>
        <h1>penGUIniX Virtual Machine</h1>
<div class="register">
    <br/>
        <img src="pencil-icon.png" alt="pencil-icon" style="float:left;width: 50px;height: 50px; ">
        <br/> <br/> <br/> <br/>
        <?php include("erori.php"); ?>
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
                <input type="submit" style="background-color=blue" value="Add Machine" class="add" name="addmachine" onclick="window.location.href='file:///C:/Users/Denisa%20Irina/Desktop/TW/PROIECT/virtualmachine.html'" />
                <!-- <button class="buton2">Register</button> -->
    </form>
</div>
</body>
</html>