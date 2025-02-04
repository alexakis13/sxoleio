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

	if (isset($_POST['profileUpdBtn'])) {
		$email = $_POST['email'];
		$firstName = $_POST['name'];
		$lastName = $_POST['lastName'];
		$rolos = $_POST['rolos'];
		$userIdForUpdate = $_SESSION['userId'];

		//$sql = "UPDATE users SET email='$email', onoma = '$firstName', eponimo='$lastName', rolos='$rolos' WHERE user_id = userIdForUpdate";

		$stmt = $conn->prepare("UPDATE users SET email=:email, onoma=:onoma, eponimo=:eponimo, rolos=:rolos WHERE user_id=:userid");

		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':onoma', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':eponimo', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':rolos', $rolos, PDO::PARAM_STR);
		$stmt->bindParam(':userid', $userIdForUpdate, PDO::PARAM_STR);

		if($stmt->execute()){
			echo "Enimerwthike";
		}else{
			echo "sfalma";
		}
	}






	$userId = $_SESSION['userId'];
	$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :userId");

    $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	  <div class="mb-3">
	    <label for="exampleInputEmail1" class="form-label">Email address</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $result['email']; ?>">
	  </div>
	   <div class="mb-3">
	    <label for="exampleInputName" class="form-label">First Name</label>
	    <input type="text" class="form-control" id="exampleInputName" name="name" value="<?php echo $result['onoma']; ?>">
	  </div>
	   <div class="mb-3">
	    <label for="exampleInputLastName" class="form-label">Last Name</label>
	    <input type="text" class="form-control" id="exampleInputLastName" name="lastName" value="<?php echo $result['eponimo']; ?>">
	  </div>
	   <div class="mb-3">
	    <label for="exampleInputRole" class="form-label">Role</label>
	    <select id="exampleInputrole" name="rolos">
	    	<option value="0">Admin</option>
	    	<option value="1">Teacher</option>
	    	<option value="2">Student</option>
	    </select>
	  </div>
	  <input type="submit" name="profileUpdBtn" class="btn btn-primary" value="Update">
	</form>
</div>


<?php 

}

include("footer.php");