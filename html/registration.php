<?php
$host = "107.180.1.16:3306";
$username = "sprc2023team2";
$password = "sprc2023team2";
$dbname = "sprc2023team2";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['psw'];
  $position = $_POST['position'];
  $career = $_POST['goal'];
  $alma = $_POST['alma'];
  $role = $_POST['role'];

  $stmt = $conn->prepare("INSERT INTO users (username, password, email, position, career_goal, alma_matter, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $name, $password, $email, $position, $career, $alma, $role);

  if ($stmt->execute() === TRUE) {
      header("Location: ../html/home.php");
      exit();
  } else {
      echo "Error: " . $stmt->error;
  }
  $stmt->close();
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="../style.css">
    <script type="text/javascript" src="../javascript.js"></script>

    <title>Mentor/Mentee Forum</title>
</head>

<body>
  <header>
	  <h1>Create An Account</h1>
	</header>
  <main class="account">
    <form method="POST">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
    <div id="inputs">
      <table>
        <tr>
          <td>
            <label for="name"><b>Username: </b></label>
            <input type="text" placeholder="Enter Username" name="name" required>
          </td>
          <td>
            <label for="email"><b>Email: </b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
          </td>
          <td>
            <label for="psw"><b>Password: </b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="position"><b>Position: </b></label>
            <input type="text" placeholder="Enter Position" name="position" required>
          </td>
          <td>
            <label for="goal"><b>Career Goal: </b></label>
            <input type="text" placeholder="Enter Career Goals" name="goal" required>
          </td>
          <td>
            <label for="alma"><b>Alma Mater: </b></label>
            <input type="text" placeholder="Enter Alma Mater" name="alma" required>
          </td>
        </tr>
        <tr>
          <td>
          </td>
          <td>
            <p><b>Role:</b></p>
            <input type="radio" id="mentor" name="role" value="mentor" required>
            <label id="role">Mentor</label>
            <input type="radio" id="mentee" name="role" value="mentee" required>
            <label id="role">Mentee</label>
          </td>
        </tr>
        </table>

    <div id="buttons">
      <br>
      <a href="./home.php"><button type="button" class="btn">Cancel</button></a>
      <a href=#><button type="submit" class="btn">Sign Up</button></a>
    </div>
    </div>
    </div>

  </main>

</body>
</html>
