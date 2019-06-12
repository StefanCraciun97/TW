<?php
session_start();
// initializing variables
	
	$numevm ="";
    $ip="";
    $os="";
    $useracc="";
	$errors = array(); 
// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'penguinix');
	if(isset($_POST['addmachine'])){
		//receive all input values from the form
		$numevm = mysqli_real_escape_string($db,$_POST['namevm']);
		$ip = mysqli_real_escape_string($db,$_POST['ip']);
        $os = mysqli_real_escape_string($db,$_POST['os']);
        $useracc=mysqli_real_escape_string($db,$_POST['useraccess']);
   // form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
		if(empty($numevm)) { array_push($errors,"Trebuie sa introduceti numele masinii virtuale.");}
		if(empty($ip)) { array_push($errors,"Trebuie sa introduceti adresa ip.");}
		if(empty($os)) { array_push($errors,"Trebuie sa introduceti sistemul de operare.");}
        if(empty($useracc)) { array_push($errors,"Trebuie sa introduceti numele utilizatorului care are acces.");}
		//first check the database to make sure
		//a user does not already exist with the same username
        $vm_check_query = "SELECT * FROM virtualmachine WHERE name='$numevm' LIMIT 1";
		$result = mysqli_query ($db , $vm_check_query);
		$vm = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($vm){ //if vm exists
			if($vm['name']== $numevm){
				array_push($errors, "Aceasta masina virtuala exista deja");}
			}
			$q = "SELECT count(username) as cnt from users where username='$useracc'";
			$r1= mysqli_query($db,$q);
			$ro = mysqli_fetch_array($r1,MYSQLI_ASSOC);
			if($ro['cnt']<1){array_push($errors,"Nu exista acest utilizator");}
		//Finally , register user is there are no errors in the form
		if(!count($errors)){
			$query = "select id from users where username='$useracc'";
			$res = mysqli_query($db,$query);
			$arr = mysqli_fetch_array($res , MYSQLI_ASSOC);
			$idacc = $arr['id'];
			$query1="INSERT INTO virtualmachine (name,ip,os)
					VALUES ('$numevm','$ip','$os')";
			mysqli_query($db, $query1);
			
			$query = "select * from virtualmachine where name= '$numevm'";
			$res = mysqli_query($db,$query);
			$arr1 = mysqli_fetch_array($res,MYSQLI_ASSOC);
			$idvm = $arr1['idmachine'];
			$query = "INSERT INTO useraccess values ($idacc,$idvm)";
			mysqli_query($db,$query);	
			$success_message = "<center>Ati adaugat masina virtuala cu succes!";
		}
	}