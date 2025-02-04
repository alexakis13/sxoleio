<?php 
//include("functions.php");
include("header.php");

if (isset($_POST['registerBtn'])) {
  $email = $_POST['email'];
  $password = $_POST['pwd'];

  try{

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");

    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

      ?>

      <div class="alert alert-primary" role="alert">
        Yparxei idi logariasmos me afto to mail!
      </div>

    <?php

    }else{

      $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
      $conn->exec($sql);

      ?>

      <div class="alert alert-primary" role="alert">
        Eggrafikate epitixos!
      </div>

    <?php

    }

    //$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    //$conn->exec($sql);
    //echo "Eggrafikate epitixos";

  } catch (PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
  }

  ?>

    <!-- <div class="alert alert-primary" role="alert">
      Eggrafikate epitixos!
    </div> -->

<?php

}


?>
<div class="container">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
  </div>
  <input type="submit" name="registerBtn" class="btn btn-primary" value="Register">
  <a href="/login.php" class="btn btn-outline-success">Σύνδεση</a>
</form>
</div>
<?php 
include("footer.php");