<?php
	require('server.php');
?>

<?php if(isset($_SESSION['userName'])) : ?>	
<?php
	// ob_start();


	$upload=0;
	$drop=0;
	$take=0;
	$upl=0;
	$upl2=0;
	
	$userName = $_SESSION['userName'];
	$query_1= "SELECT * FROM users WHERE username ='$userName';";
	$result_1 =mysqli_query($conn, $query_1);
	$value = mysqli_fetch_assoc($result_1);
	mysqli_free_result($result_1);


			if(is_array($_FILES)) 
			{if(isset($_FILES['image'])){
			 if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			  $sourcePath = $_FILES['userImage']['tmp_name'];
			  $targetPath = "images/".$_FILES['userImage']['name'];
			  if(move_uploaded_file($sourcePath,$targetPath)) {
			  ?>
			   <img src="<?php echo $targetPath; ?>">
			   <?php
			   exit();
			  }
			 }
			}
			}
			if(isset($_GET['upl'])){
			 		if($_GET['upl']==1){
			 			$upl=1;
						
			 		}
		
			 	}
			 		if(isset($_GET['upl2'])){
			 		if($_GET['upl2']==1){
			 			$upl2=1;
						
			 		}
		
			 	}
			 if(isset($_GET['upl1'])){
			 		
			 			$upl1=1;
			 			$w=0;
						$fin="files/".$_GET['upl1'];
						$query = "INSERT INTO images(username,imgpath,web) VALUES ('$userName','$fin','$w');";
						$result = mysqli_query($conn, $query);
						if(!$result) echo mysqli_error($conn);
						
			 		
		
			 	}
			$dir="";
			// if(isset($_GET['im'])){
			// 		$dir=$_GET['im'];
			// 		$w=0;
			// 		$query = "INSERT INTO images(username,imgpath,web) VALUES ('$userName','$dir','$w');";
			// 				$result = mysqli_query($conn, $query);
							
			// 		}
				if(isset($_GET['d'])){
					if($_GET['d']==1){
						$upload=0;
						$drop=1;
						$take=0;
					}
		
				}
		if(isset($_GET['u'])){
					if($_GET['u']==1){
						$upload=1;
						$drop=0;
						$take=0;
					}
		
				}
		if(isset($_GET['t'])){
					if($_GET['t']==1){
						$upload=0;
						$drop=0;
						$take=1;
					}
		
				}
?>



<!DOCTYPE html>
<html>
<head>
	<title>uploadFile</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<link rel="stylesheet" type="text/css" href="dyslexie.css">


     <meta charset="utf-8">
				    <meta http-equiv="X-UA-Compatible" content="IE=edge">
				    <meta name="viewport" content="width=device-width, initial-scale=1">
				    
				    <meta name="description" content="">
				    <meta name="author" content="">
				    <link rel="icon" href="../../favicon.ico">
				    <title>Dyscipher</title>
				    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
				   

				      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
				    <link rel="stylesheet" type="text/css" href="main.css">
				    <style>
				#camera {
				  width: 50%;
				  height: 350px;
				  margin-left: 25%;
				}

				</style>
		
		<link rel="stylesheet" type="text/css" href="upload_style.css">
			<script type="text/javascript" src="jquery.js"></script>
			<script type="text/javascript" src="upload_script.js"></script>


</head>
<body>

	

		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top ">
			<!-- fixed-top -->
		    <a href="#" class="navbar-brand">Dyscipher</a>
		    <a href="#" class="navbar-brand" style ="padding-left: 2%;"><small>Hello <?php echo $value['firstName']; ?> !</small></a>
		    <button class = "navbar-toggler" data-toggle = "collapse" data-target="#menu">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class ="collapse navbar-collapse" id = "menu">
		      	<ul class="navbar-nav ml-auto" >
		      <!-- 	<li class="nav-item"><a href="activity.php" class = "nav-link">Activity</a></li> -->
		      	<li class="nav-item"><a href="main.php" class = "nav-link" style="color:#fff;">Home</a></li>
		      	<li class="nav-item"><a href="chat.php" class = "nav-link">Chat</a></li>
		   		<li class="nav-item"><a href="#" data-toggle="modal" data-target ="#demo" class = "nav-link">Profile</a></li>
		        <li class="nav-item"><a href="server.php?exit='1';" class = "nav-link">Logout</a></li>
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


	   
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		 
		<div style = "background-image:url('images/image40.jpg');position:relative;opacity:1;background-position:center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;max-height:1100px;min-height: 100%">

			<div class = "container" style="padding-top:1%;padding-bottom: 5%;">


				        <!-- /container -->
				 
				 
				 
				
		<?php if(($upl == 0)&&($upl1 == 0)&&($upl2==0)): ?>
		

			<div class="card text-center" style="margin-top:5%;">
			  <div class="card-header">
			    <ul class="nav nav-tabs card-header-tabs">
			      <li class="nav-item">
			        <a class="nav-link active" href="upload.php?d=1">Drag and drop</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="upload.php?u=1">Upload File</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link disabled" href="upload.php?t=1">Take a photo</a>
			      </li>
			    </ul>
			  </div>
			  <div class="card-body" style="background-image:url('images/image5.jpeg');">
			  	<?php if(($upload == 0) && ($drop == 0) &&($take == 0)): ?>
			  		<h5 class="card-title" style="color:#fff;">Choose the mode of upload of your picture</h5>
			  	<?php endif ; ?>
			  	<?php if(($upload == 1) || ($drop == 1) || ($take == 1)): ?>
			  	<div class = "container" style ="padding-top: 5%;padding-right: 0px;padding-left: 0px;padding-bottom: 5%; margin: auto;margin-top: 2%;margin-bottom: 2%; align-self: center;">
			    
			    <!-- <p class="card-text"></p>
			    <a href="#" class="btn btn-primary">Go somewhere</a> -->



			    <?php if($drop == 1): ?>
			    			<!-- <div>
								<div id="wrapper">
								 <input type="file">
								 <div id="drop-area">
								  <h3 class="drop-text">Drag and Drop Images Here</h3>
								 </div>
								</div>
							</div> -->
							
							<label style="color:#fff;"><h5>Upload by dropping image files</h5></label>
							<div class="container">
							<form action=" " class="dropzone">
								
							<?php
							$dir    = 'files';
							$files1 = scandir($dir, 1);
							$w=0;
							$fin=$files1[0];
							// $query = "INSERT INTO images(username,imgpath,web) VALUES ('$userName','$fin','$w');";
							// $result = mysqli_query($conn, $query);
							// header('location: upload.php');
							
							
							?>
							<!-- displays in the increasing order of the file name -->
							</form>
						</div>
						<div style = "margin-left: 0%;margin-top: 30px;">
							<?php
					 
					        		echo '<a class="btn btn-outline-warning" style="width:200px;" href="upload.php?upl1='.$fin.'">Submit</a>';
					        ?>
					        	</div>



			    <?php endif ; ?>



			    <?php if($take == 1): ?>
			    	<label style="color:#fff;padding-top: 2%;"><h5>Upload using Webcam</h5></label>
			    	<div class="container">

				          <div class="text-center">
							   <div id="camera_info"></div>
							    <div id="camera"></div><br>
							    


							    <div style = "margin-left: 0%;margin-top: 30px;">
							    	<button id="take_snapshots" class="btn btn-danger btn-sm " style="width:200px;">Take Snapshots</button>
					        			<!-- <button type = "submit" class = "btn btn-outline-warning" style="width:200px;" name ="create" >Upload Image</button> -->
					        		</div>
					        		<div style = "margin-left: 0%;margin-top: 30px;">
							    	
							    	<a class="btn btn-danger" style="width:200px;" href="upload.php?upl2=1">Submit</a>
					        			<!-- <button type = "submit" class = "btn btn-outline-warning" style="width:200px;" name ="create" >Upload Image</button> -->
					        		</div>

							      </div>
							     </div>
							      <!-- <div style = "margin:auto;margin-top: 30px;">
							            <table class="table table-bordered">
							            <thead>
							                <tr>
							                    <th style="width:50%">Image</th><th>Image Name</th>
							                </tr>
							            </thead>
							            <tbody id="imagelist">
							            
							            </tbody>
							        </table>
							        </div> -->
							    </div>
							   
				   			
				   		</div>

			    <?php endif ; ?>




			    <?php if($upload == 1): ?>

					
				      
				      <form method = "POST" style = "width: 60%; margin:auto;" action ="upload.php?u=1">
				      	
							<div class = "form-group">
				              <label style="color:#fff"><h5>Upload using file directory</h5></label>
				              <input type="text" name = "image" class ="<?php echo $imgClass;?>" placeholder="image name with extension" >
				              <!-- value="<?php echo isset($_POST['image']) ? $imageLink : "";?>" -->
				              <div class = "invalid-feedback"><?php echo $imgComment; ?></div>
				              <small style="color:#fff">Press upload to continue</small>
				            </div>
				         
					        <div class="row">
					        	<div class = "col">
					        		<div style = "margin-left: 0%;margin-top: 30px;">
					        			<button type = "submit" class = "btn btn-outline-warning" style="width:200px;" name ="create" >Upload Image</button>
					        		</div>
					        	</div>
					        </div>
				   
				      	</form>
				  	

			    <?php endif ; ?>






			  </div>
			  <?php endif ; ?>
			</div>
			</div>
	<?php endif ; ?>
	<?php if(($upl == 1)||($upl1==1)||($upl2==1)): ?>

	
		<!-- <nav id="navbar-example2" class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="#">Navbar</a>
		  <ul class="nav nav-pills">
		    <li class="nav-item">
		      <a class="nav-link" href="#fat">@fat</a>
		    </li>

		    <li class="nav-item dropdown">
		      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
		      <div class="dropdown-menu">
		        <a class="dropdown-item" href="#one">one</a>
		        <a class="dropdown-item" href="#two">two</a>
		        <div role="separator" class="dropdown-divider"></div>
		        <a class="dropdown-item" href="#three">three</a>
		      </div>
		    </li>
		  </ul>
		</nav>
		<div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
		  <h4 id="fat">@fat</h4>
		  <p class="para" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		  
		</div> -->
		<textarea class ="container para" id="text" style="margin-top:7%;" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>

	

		<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		       <img class="d-block w-100" src="images/image2.jpeg" alt="First slide"> 
		      
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src=".../800x400?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide">
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="images/image12.jpg" alt="Third slide">
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
</div> -->

	<?php endif ; ?>




			   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
				<script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script>

				    <script>
				    var options = {
				      shutter_ogg_url: "jpeg_camera/shutter.ogg",
				      shutter_mp3_url: "jpeg_camera/shutter.mp3",
				      swf_url: "jpeg_camera/jpeg_camera.swf",
				    };
				    var camera = new JpegCamera("#camera", options);
				  
				  $('#take_snapshots').click(function(){
				    var snapshot = camera.capture();
				    snapshot.show();
				    
				    snapshot.upload({api_url: "action.php"}).done(function(response) {
				$('#imagelist').prepend("<tr><td><img src='"+response+"' width='100px' height='100px'></td><td>"+response+"</td></tr>");
				}).fail(function(response) {
				  alert("Upload failed with status " + response);
				});
				})
				 
				function done(){
				    $('#snapshots').html("uploaded");
				}
				</script>
	

      

     
   

	

  	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php 
$target_path='files/';
if(!empty($_FILES['file']['tmp_name'])){
	$target_path=$target_path.$_FILES['file']['name'];
	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){}
}
?>
<?php endif; ?>