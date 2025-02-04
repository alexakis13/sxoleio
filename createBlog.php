<?php 
include("header.php");

if (!isset($_SESSION['userId'])) {

?>

	<div class="alert alert-primary" role="alert">
        Sindetheite gia na deite afti tin selida
        <a href="/login.php" class="btn btn-outline-success">Σύνδεση</a>
    </div>

<?php

}else{

	if (isset($_POST['postCreate'])) {
	  $title = $_POST['title'];
	  $content = $_POST['content'];
	  $date = $_POST['datetime'];
	  $author_id = $_SESSION['userId'];



	   $target_dir = "uploads/";
		 $target_file = $target_dir . $_FILES["postImg"]["name"];
		 $uploadOk = 1;
		 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  try{

	  		$check = getimagesize($_FILES["postImg"]["tmp_name"]);
		  if($check !== false) {
		    echo "File is an image - " . $check["mime"] . ".";
		    $uploadOk = 1;
		  } else {
		    echo "File is not an image.";
		    $uploadOk = 0;
		  }

		  // Check if file already exists
			if (file_exists($target_file)) {
			  echo "Sorry, file already exists.";
			  $uploadOk = 0;
			}

			// Check file size
			if ($_FILES["postImg"]["size"] > 500000) {
			  echo "Sorry, your file is too large.";
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}






	      $sql = "INSERT INTO posts (author_id, title, content, imgurl, publish_at) VALUES (author_id,'$title','$content','$target_file','$date')";

	      if($conn->exec($sql)){

	      	if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["postImg"]["tmp_name"], $target_file)) {
			    echo "The file ". htmlspecialchars($_FILES["postImg"]["name"]). " has been uploaded.";
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
			}

	      }




	      ?>

	      <div class="alert alert-primary" role="alert">
	        Eggrafikate epitixos!
	      </div>

	    <?php

	  } catch (PDOException $e){
	    echo $sql . "<br>" . $e->getMessage();
	  }
	}

?>

<div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
      	<div class="mb-3">

			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Post Title</label>
			  <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
			</div>
			<div class="mb-3">
			  <label for="exampleFormControlTextarea1" class="form-label">Goldtent</label>
			  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
			</div>
			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Publish Date-Time</label>
			  <input type="date" class="form-control" id="exampleFormControlInput1" name="datetime">
			</div>
			<div class="mb-3">
			  <input type="file" class="form-control" id="inputGroupFile" name="postImg">
			</div>
			<div class="mb-3">
			  <input type="submit" name="postCreate" class="btn btn-primary" value="Create Post">
			</div>

		</div>
	</form>
</div>

<?php

}

include("footer.php");