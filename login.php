<?php 
//include("functions.php");
include("header.php");

if (!isset($_SESSION['userId'])) {

  if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    try{
      $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = :email AND password = :password");

      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);

      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result) {
        $_SESSION['userId'] = $result['user_id'];
      }

      //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      // if ($stmt->rowCount() > 0) {
      //   foreach ($result as $row) {
      //     echo "ID: ". htmlspecialchars($row['user_id'])."<br>";
      //     echo "Email: ". htmlspecialchars($row['email'])."<br>";
      //     echo "Password: ". htmlspecialchars($row['password'])."<br>";
      //     echo "Role: ". htmlspecialchars($row['rolos'])."<br>";
      //   }
      // }else{
      //   echo "Den exei vrethei xristis me afta ta stoixeia";
      // }

      header("Location: index.php");

    }catch(PDOException $e){
      echo "Error: " .$e->getMesage();
    }
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
      <input type="submit" name="loginBtn" class="btn btn-primary" value="Sindesi">
      <a href="/register.php" class="btn btn-outline-success">Εγγραφή</a>
    </form>
  </div>


<?php 

}else{

  echo "Eisai o user me ID: ".$_SESSION['userId'];

}

include("footer.php");