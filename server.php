<?php
	

	session_start();

	// require('connection.php');
	

	
	$nomatch = 0;
	$email_1="";
	$userName_1="";


	$emailComment="";
	$firstComment ="";
	$lastComment="";
	$pass1Comment ="";
	
	
	$emailClass='form-control';
	$firstClass='form-control';
	$lastClass='form-control';
	$pass2Class='form-control';
	$userClass='form-control';
	$pass1Class='form-control';
	$passClass='form-control';

	$titleClass='form-control';
	$contentClass='form-control';

	$cardClass='card text-white';

	$taskClass='form-control';
	$nameClass='form-control';
	$nameComment ="";

	$timeClass='form-control';
	$numberClass='form-control';
	$timeComment ="";
	$numberComment ="";
	$passComment = "";
	$comComment = "";
	$comClass='form-control';

	$imgComment="";
	$imgClass='form-control';

	$upl=0;
	$upl1=0;
		
	// if(isset($_GET['resname'])){
	// 	$resname = $_GET['resname'];
	// }
	



	//logout
	if(isset($_GET['exit'])){
		session_destroy();
		//echo $_SESSION['userName'];
		mysqli_close($conn);
		header('location: main.php');
		}



	

	$conn = mysqli_connect('localhost', 'root', '123456', 'Dyscipher');
	
	//Check connection
	if(mysqli_connect_errno()){
		//Connection failed
		echo "Failed to connect to mysql".mysqli_connect_errno();
	}
	else{
		//connection made

		//if(filter_has_var(INPUT_POST, "submit")){
		if(isset($_POST['submit'])){
						//Get values if data exists
						$userComment ="";
						$pass2Comment ="";
						$count = 0;
						$userName = mysqli_real_escape_string($conn, $_POST['userName']);
						$userName = filter_var($userName, FILTER_SANITIZE_SPECIAL_CHARS);
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						$password = mysqli_real_escape_string($conn, $_POST['password']);
						$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
						$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
						$firstName = filter_var($firstName, FILTER_SANITIZE_SPECIAL_CHARS);
						$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
						$lastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS);
						$name = $firstName." ".$lastName;
						$type = mysqli_real_escape_string($conn, $_POST['type']);
						$t=0;
						//$field =[$firstName, $lastName, $email, $userName, $password_2];

						if($type=="Mentor"){
							$t=1;
						}else{
							$t=0;
						}

						if(empty($firstName)){
							$firstComment="First Name is Required!";
							$firstClass=$firstClass." "."is-invalid";

							}
						else{
							//if(!filter_var($firstName, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^M(.*)/")))){
							//$firstName_1 = filter_var($firstName, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
								if(ctype_alpha($firstName)){
									$firstClass=$firstClass." "."is-valid";
									$count++;
								}
								else{
									$firstComment="Invalid First Name";
									$firstClass=$firstClass." "."is-invalid";

								}
							}
								


						if(empty($lastName)){
							$lastComment="Last Name is Required!";
							$lastClass=$lastClass." "."is-invalid";

							}
						else{
								if(ctype_alpha($lastName)){
									$lastClass=$lastClass." "."is-valid";
									$count++;

								}
								else{
									$lastComment="Invalid Last Name";
									$lastClass=$lastClass." "."is-invalid";
								}
							}
						


						if(empty($email)){
							$emailComment="E-mail is Required!";
							$emailClass=$emailClass." "."is-invalid";

							}
						else{
							if(filter_var($email,FILTER_VALIDATE_EMAIL)){
								$emailClass=$emailClass." "."is-valid";
								$count++;
								}
								else{
									$email_1=filter_var($email, FILTER_SANITIZE_EMAIL);
									$emailComment="Invalid E-mail ID, try using ".$email_1;
									$emailClass=$emailClass." "."is-invalid";
								}
							}



						if(empty($userName)){
							$userComment="User Name is Required!";
							$userClass=$userClass." "."is-invalid";

							}
							else{
								$userName_1 = filter_var($userName, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
								if(!strcmp($userName,$userName_1)){
									$query_1= "SELECT * FROM users WHERE username ='$userName'";
									$result_1 =mysqli_query($conn, $query_1);
									if(mysqli_num_rows($result_1)!=0)
									{	
										echo mysqli_num_rows($result_1);
										$userClass=$userClass." "."is-invalid";
										$userComment="User Name already Exists!";
									}else{
										$userClass=$userClass." "."is-valid";
										$count++;
									}
									mysqli_free_result($result_1);

								}
								else{
									$userComment="Invalid Username";
									$userClass=$userClass." "."is-invalid";
								}
							}


						if(empty($password)){
							$pass1Comment="Password is Required!";
							$pass1Class=$pass1Class." "."is-invalid";

							}
							else{
								$count++;
							}
							



						if(empty($password_2)){
							$pass2Comment="Re-enter your Password";
							$pass2Class=$pass2Class." "."is-invalid";

							}
							else{
								$count++;
							}
						if($password != $password_2){
							$pass2Comment="Passwords don't match !";
							$pass2Class=$pass2Class." "."is-invalid";

						}else{
							if($password != "")
								$count++;
						}
							
						


						if($count == 7){
							$password = md5($password_2);//Encrypt password
							$query = "INSERT INTO users(username,email,password,name,firstName,lastName,mentor) VALUES ('$userName','$email','$password','$name','$firstName','$lastName','$t');";
							$result = mysqli_query($conn, $query);
							$_SESSION['userName'] = $userName;
							$_SESSION['login'] = 1;
							mysqli_free_result($result);
							header('location: main.php');
						}
						/*
									for($i=0;$i<5;$i++){
										if(empty($field[$i])){
										$comment[$i]=$fname[$i]." is Required!";
										$class[$i]=$class[$i]." "."is-invalid";
										

										}
										else{
										$class[$i]=$class[$i]." "."is-valid";
										}
									}
									print_r($comment);

						*/
		}

		else if(isset($_POST['signIn'])){


							$userComment ="";
							$pass2Comment ="";
							$nomatch = 0;
							$count = 0;
							$userName = mysqli_real_escape_string($conn, $_POST['userName']);
							$userName = filter_var($userName, FILTER_SANITIZE_SPECIAL_CHARS);
							$password = mysqli_real_escape_string($conn, $_POST['password']);
					

							

							if(empty($userName)){
								$userComment="User Name is Required!";
								$userClass=$userClass." "."is-invalid";

								}
							else{
								$userClass=$userClass." "."is-valid";
								$count++;
								}

								


							if(empty($password)){
								$pass1Comment="Password is Required!";
								$pass1Class=$pass1Class." "."is-invalid";

								}
							else{
								$count++;
								}
							

							

							if($count == 2){
								$password = md5($password);
								$query_1= "SELECT * FROM users WHERE username ='$userName' AND password ='$password';";
								$result_1 =mysqli_query($conn, $query_1);

								if(mysqli_num_rows($result_1) == 1){
									$_SESSION['userName'] = $userName;
									$_SESSION['login'] = 1;
									mysqli_free_result($result_1);
									header('location: main.php');

								}else{
									$nomatch = 1;
									
								}

							}
		

		}
		else if(isset($_POST['update'])){

						$emailComment="";
						$firstComment ="";
						$lastComment="";
						$count = 0;
						$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
						$firstName = filter_var($firstName, FILTER_SANITIZE_SPECIAL_CHARS);
						$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
						$lastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS);
						$email = mysqli_real_escape_string($conn, $_POST['email']);
						$userName = $_SESSION['userName'];


						if(empty($firstName)){
							$firstComment="First Name is Required!";
							$firstClass=$firstClass." "."is-invalid";

							}
						else{
								if(ctype_alpha($firstName)){
									$firstClass=$firstClass." "."is-valid";
									$count++;
								}
								else{
									$firstComment="Invalid First Name";
									$firstClass=$firstClass." "."is-invalid";

								}
							}
								


						if(empty($lastName)){
							$lastComment="Last Name is Required!";
							$lastClass=$lastClass." "."is-invalid";

							}
						else{
								if(ctype_alpha($lastName)){
									$lastClass=$lastClass." "."is-valid";
									$count++;

								}
								else{
									$lastComment="Invalid Last Name";
									$lastClass=$lastClass." "."is-invalid";
								}
							}
						


						if(empty($email)){
							$emailComment="E-mail is Required!";
							$emailClass=$emailClass." "."is-invalid";

							}
						else{
							if(filter_var($email,FILTER_VALIDATE_EMAIL)){
								$emailClass=$emailClass." "."is-valid";
								$count++;
								}
								else{
									$email_1=filter_var($email, FILTER_SANITIZE_EMAIL);
									$emailComment="Invalid E-mail ID, try using ".$email_1;
									$emailClass=$emailClass." "."is-invalid";
								}
							}




							if($count==3){
								$name = $firstName." ".$lastName; 
								$query = "UPDATE users SET email = '$email', firstName = '$firstName', lastName = '$lastName', name = '$name' WHERE username='".$_SESSION['userName']."';";
								$result = mysqli_query($conn, $query);
								mysqli_free_result($result);
								header('location: index.php');
							}
		}
		else if(isset($_POST['changePass'])){


								$count =0;
								$passComment ="";
								$pass1Comment ="";
								$pass2Comment ="";
								$password = mysqli_real_escape_string($conn, $_POST['password']);
								$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
								$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
								$userName = $_SESSION['userName'];

								if(empty($password)){
									$passComment="Password is Required!";
									$passClass=$passClass." "."is-invalid";

								}
								else{
									$count++;
								}

								if(empty($password_1)){
									$pass1Comment="Enter the New Password";
									$pass1Class=$pass1Class." "."is-invalid";

								}
								else{
									$count++;
								}

								if(empty($password_2)){
									$pass2Comment="Re-enter your New Password";
									$pass2Class=$pass2Class." "."is-invalid";

								}
								else{
									$count++;
								}


								if($password_1 != $password_2){
									$pass2Comment="Passwords don't match !";
									$pass2Class=$pass2Class." "."is-invalid";

								}else{
										if($password != "")
											$count++;
								}

								if($count==4 ){
									$password =md5($password);
									$password_1 =md5($password_1);
									$userName = $_SESSION['userName'];
									$query_1= "SELECT * FROM users WHERE username ='$userName'";
									$result_1 =mysqli_query($conn, $query_1);
									$value = mysqli_fetch_assoc($result_1);
									mysqli_free_result($result_1);

									if(!strcmp($value['password'],$password)){
										//write the new password
										$query_1= "UPDATE users SET password = '$password_1' WHERE username='".$_SESSION['userName']."';";
										$result_1 =mysqli_query($conn, $query_1);
										
										$nomatch = 2;
										
									}else{
										$passComment="Wrong Password";
										$passClass=$passClass." "."is-invalid";
									}
								}



		}
		else if(isset($_POST['create'])){
								
									
									$count = 0;
									$edit =0;
									$imageComment ="";
	
							
					
									$imageLink = mysqli_real_escape_string($conn, $_POST['image']);
									// if($imageLink!=""){
									// 	$id = $_GET['id'];

									// }
									$userName = $_SESSION['userName'];

									


									if($imageLink == ""){
										$imgComment="Image is Required!";
										$imgClass=$imgClass." "."is-invalid";

									}

									
									else if($imageLink != "") {
										//write into the database 
										$upl=1;
										$query = "INSERT INTO images(username,imgpath) VALUES ('$userName','$imageLink');";
										$result = mysqli_query($conn, $query);
										// mysqli_free_result($result);
										
									}

									// if($count == 2 && $edit){
									// 	date_default_timezone_set('Asia/Kolkata');
									// 	$date = date('Y-m-d H:i:s');
									// 	$query = "UPDATE notes SET username = '$userName',title = '$title',content = '$content',dt = '$date',image = '$imageLink',type = '$color' WHERE id= $id;";

									// 	$result = mysqli_query($conn, $query);
									// 	header('location: index.php');
									// }





		}
		
		

	}


	




?>