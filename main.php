
<?php
	require('server.php');

	if(isset($_SESSION['userName'])){
	$userName = $_SESSION['userName'];

	$query_1= "SELECT * FROM users WHERE username ='$userName';";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dyscipher</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<!-- fixed-top -->
		    <a href="#" class="navbar-brand">Dyscipher</a>
		    <?php if(isset($_SESSION['userName'])) : ?>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <?php endif; ?>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      <!-- 	<li class="nav-item"><a href="activity.php" class = "nav-link">Activity</a></li> -->
		      <?php if(isset($_SESSION['userName'])) : ?>	
		      	<li class="nav-item"><a href="upload.php" class = "nav-link">Upload</a></li>
		      	<li class="nav-item"><a href="chat.php" class = "nav-link">Chat</a></li>
		        <li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link">Profile</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
		      <?php endif; ?>
		      <?php if(!isset($_SESSION['userName'])) : ?>
		     	 <li class="nav-item"><a href="SignIn.php" class = "nav-link" style="color:#fff;">Sign-In</a></li>
		     <?php endif; ?>
		        </ul>
		    </div>
		</nav>
		

		<div class="modal fade" id = "demo">
	      <div class ="modal-dialog">
	        <div class = "modal-content">
	          
	          <div class = "modal-header">
	            <h2 class = "modal-title">Profile</h2>
	            <span type ='button' class = "close" data-dismiss = "modal">&times;</span>
	          </div>
	          <div class = "modal-body">
	          	
	          	<table class="table table-dark">
				  <tbody>
				    <tr >
				      <th scope="row">Name: </th>
				      <td ><?php echo $value['name']; ?></td>
				      
				    </tr>
				     <tr class="bg-bright">
				      <th scope="row">Accout Type: </th>
				      <td ><?php if($value['mentor']==1) echo "Mentor";else echo "Peer"; ?></td>
				      
				    </tr>
				    <tr>
				      <th scope="row">E-mail: </th>
				      <td><?php echo $value['email']; ?></td>
				     
				    </tr>
				    <tr class="bg-bright">
				      <th scope="row">Username: </th>
				      <td><?php echo $userName; ?></td>
				      
				    </tr>
				  </tbody>
				</table>
	         
	          </div>
	          <div class = "row" style ="padding-top: 0;padding-bottom: 1.5rem;padding-left: 1rem;">
		        <div class = "col-md-6 col-sm-6 col-xs-6">
		           <a href="editProfile.php"><button type = "button" class = "btn btn-dark" >Edit Profile</button></a>
		        </div>
		        <div class = "col-md-6 col-sm-6 col-xs-6">
	            	 <a href="changePass.php"><button type = "button" class = "btn btn-dark" >Change Password</button></a>
	          	</div>
	          </div>

	        </div>
	      </div>
	    </div>



	<div class= "image1">
		<div class= "text">
			<span class="border">
				Dyscipher
			</span>
		</div>
	</div>

	<section class ="section section-light">
		<h2>Optical Character Recogniser</h2>
		<p>Take a picture of the writtent text and let our software recognise and synthesize handwritten text of an individual with dyslexia. It uses machine learning algorithms to try and make meaningful sentences from the perceived words. We aim to bridge the communication gap between the person with the disorder and the other normal interlocutor.</p>
	</section>

	<div class= "image2">
		<div class= "text">
			<span class="border trans">
				Eliminate the conscious stress to be correct.
			</span>
		</div>
	</div>

	<section class ="section section-dark">
	<h2>Connect with fellow dyslexics</h2>
	<p>Join the bright minded community of dyslexics and feel at home in this huge wide world.Start up a conversation with either a mentor or a fellow dyslexic while maintaining anonymity in chat.Let the mental health bloom.</p>
	</section>

	<div class= "image3">
		<div class= "text">
			<span class="border trans">
				Read with ease through our customised font.
			</span>
		</div>
	</div>

	<section class ="section section-dark">
	<h2>Guidance from mentors</h2>
	<p>Allows mentors to monitor the mental health of the studets and provide the necessary guidance when prompted. A warmer and a constructive learning environment for all without an eye of discrimination.</p>
	</section>

	<div class= "image4">
		<div class= "text">
			<span class="border">
				Support at Arms' length
			</span>
		</div>
	</div>

	<footer style = "text-align: center; padding: 2rem 1rem; margin: auto; color: #333; background-color:#000;">
		<h3>Get in Touch</h3>
		<p>If you find any problems, connect with us:</p>
		<p>Email: <strong>dyscipher@gmail.com</strong></p>
		<p>Phone: <strong>(044) 12345678 </strong></p>
	</footer>


	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
