<?php
session_start();

// initializing variables
	$username = "";
	$nume ="";
	$prenume ="";
	$password_1 = "";
	$email  = "";
	$errors = array(); 

// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'penguinix');
	if(isset($_POST['register'])){
		//receive all input values from the form
		$nume = mysqli_real_escape_string($db,$_POST['fname']);
		$prenume = mysqli_real_escape_string($db,$_POST['lname']);
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password_1 = mysqli_real_escape_string($db,$_POST['password']);

   // form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
		if(empty($username)) { array_push($errors,"Trebuie sa introduceti numele de utilizator.");}
		if(empty($nume)) { array_push($errors,"Trebuie sa introduceti numele.");}
		if(empty($prenume)) { array_push($errors,"Trebuie sa introduceti prenumele.");}
		if(empty($email)) { array_push($errors,"Trebuie sa introduceti email-ul.");}
		if(empty($password_1)) { array_push($errors,"Trebuie sa introduceti parola.");}

		if(strlen($password_1) < 6) {array_push($errors, "Parola trebuie sa aiba cel putin 6 caractere!");}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){array_push($errors,"Introduceti un email valid!");}
		if(!preg_match("/^[a-zA-Z]+$/",$nume)){array_push($errors,"Numele trebuie sa contina doar litere");}
		if(!preg_match("/^[a-zA-Z ]+$/",$prenume)){array_push($errors,"Prenumele trebuie sa contina doar litere si spatii");}
			
		//first check the database to make sure
		//a user does not already exist with the same username
		$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query ($db , $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if($user){ //if user exists
			if($user['Username'] == $username){
				array_push($errors, "Numele de utilizator exista");}
			if($user['Email'] == $email){
				array_push($errors , "Email-ul a fost utilizat");}
			}
			
		//Finally , register user is there are no errors in the form
		if(!count($errors)){
			$password = base64_encode($password_1); //encrypt the password before saving in database
			$query="INSERT INTO users ( Nume,Prenume,Email,Username,Parola)
					VALUES ('$nume','$prenume','$email','$username','$password')";
			mysqli_query($db, $query);
			$success_message = "<center>V-ati inregistrat cu succes! Acum va puteti autentifica!";
			}
	}

// LOGIN USER
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($db, $_POST['user']);
  $password = mysqli_real_escape_string($db, $_POST['pass']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = base64_encode($password);
	$q="SELECT * FROM users where Username='$username' and Parola='$password'";
	//"SELECT * FROM users where Username='stef' --' and Parola='$password'";
	echo $q;
	$res = mysqli_query($db,$q);
  	if (mysqli_num_rows($res) == 1) {
  	  $_SESSION['user_s']=$username;
	  header('location:virtualmachine.php');
  	}else {
  		array_push($errors, "Username sau parola gresita.");
  	}
  }
}

//LOG OUT
if (isset($_SESSION['log_out']))
{
    $que="UPDATE users 
			SET log_in=NULL 
			WHERE username='$username'";
	  mysqli_query($db,$que);
	  session_destroy();

header('Location: login.php');
}

