<?php
	require('server.php');

	if(isset($_SESSION['userName'])){
	$userName = $_SESSION['userName'];

	$query_1= "SELECT * FROM users WHERE username ='$userName';";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);

	if($value['mentor']==1){
		$query_3 ="SELECT * FROM users WHERE username !='$userName' mentor=1;";
	    $result_3 =mysqli_query($conn, $query_3);
		$pers = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
    	mysqli_free_result($result_3);  
	}	
	else{
		 $query_2 ="SELECT * FROM users WHERE username !='$userName'AND mentor!=1;";
	    $result_2 =mysqli_query($conn, $query_2);
		$pers = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
    	mysqli_free_result($result_2);  
	}
}

  
  if(isset($_GET['peer'])){
   
    $query_2 ="SELECT * FROM users WHERE username !='$userName'AND mentor!=1;";
	    $result_2 =mysqli_query($conn, $query_2);
		$pers = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
    	mysqli_free_result($result_2);  
  }

    if(isset($_GET['men'])){
   
    $query_3 ="SELECT * FROM users WHERE username !='$userName' mentor=1;";
	    $result_3 =mysqli_query($conn, $query_3);
		$pers = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
    	mysqli_free_result($result_3); 
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
<!-- 
------------------------------------------------------------------------------------------------------------- -->
		
<div style="margin-top: 2%">
<div class ="row">		
  <div class="col-sm-6">
    <div class="card">
    	<div class="card-header">
						    <div class ="row">
						    	<div class = "col-sm-6">
						    		<a href="#?peer=1" class="btn btn-primary">Peers</a>
						    	</div>
						    	<div class ="col-sm-6">
						    		<a href="#?men=1" class="btn btn-primary">Mentors</a>
						    	</div>
						  	</div>
		</div>
      	<div class="card-body">
      	<script>
  		
  		</script>
   
        <p id="call" class="card-text">
        
        	<?php foreach($pers as $per) : ?>
	        	<div class="alert alert-primary" role="alert">	
				  <button type="button" class = "btn btn-outline-dark" style="width:200px;align-self: center;" id="<?php echo $per['id']?>" onclick="loadXML()"><?php echo $per['username']; ?></button>
				  <input type="hidden" name="name" value = "<?php echo $per['id']?>" id='unique'>
				</div>
			<?php endforeach ; ?>
		
		</p>


		

			<script>
					function loadXML(){
				loadXMLDoc();
				window.setInterval(3000, loadXMLDoc);

			function loadXMLDoc() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			      document.getElementById("mes").innerHTML =
			      this.responseText;
			    }
			  };
			  xhttp.open("GET", "chatfetch.php?id="+document.getElementById('unique').value);
			  xhttp.send();
			}
			
			}
			</script>
        
      	</div>
    </div>
  </div>



  <div class="col-sm-6">
    <div class="card">
    	<div class="card-header">
			    Featured
		</div>
	      <div class="card-body">
	        
	        <p class="card-text" id="mes"></p>
	        <div class="row">
	        <strong style="margin-left: 5%;">Message :</strong>
				        <div class="col-md-7">
				              <textarea name="com" rows="1" class ="form-control"  placeholder="Enter message" id = "input"></textarea>
				              <div class = "invalid-feedback">Fill in the message!</div>
				        </div>
				        <div class="col-md-2 ">
				        	<button  style="width:300px;" type="button" onclick="funct()" class = "btn btn-primary" >send</button>
				        </div>
			</div>
	       
	      </div>
    </div>
  </div>
</div>

</div>

	<script>
		function funct(){
			var xml = new XMLHttpRequest();
			xml.open("GET", 'chatfetch.php?secret=1?str='+document.getElementById('input').innerHTML);
			xml.send();
			xml.onreadystatechange = function(){
				if(this.status==200 && this.readyState==4)
				{
					



				}
			}
		}
</script>

	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
